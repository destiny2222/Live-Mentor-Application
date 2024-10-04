public function WebhookGatewayCallback(Request $request)
    {
        Log::info('Webhook received', ['payload' => $request->all(), 'headers' => $request->headers->all()]);

        try {
            if (!$request->isMethod('POST')) {
                Log::warning('Invalid request method', ['method' => $request->method()]);
                return response()->json(['error' => 'Invalid request method'], 400);
            }

            if (!$request->header('X-Paystack-Signature')) {
                Log::warning('Missing Paystack signature');
                return response()->json(['error' => 'Missing Paystack signature'], 400);
            }

            $input = $request->getContent();
            $secretKey = config('services.paystack.SECRET_KEY');

            Log::info('Signature check', [
                'received' => $request->header('X-Paystack-Signature'),
                'calculated' => hash_hmac('sha512', $input, $secretKey)
            ]);

            if ($request->header('X-Paystack-Signature') !== hash_hmac('sha512', $input, $secretKey)) {
                Log::warning('Invalid signature');
                return response()->json(['error' => 'Invalid signature'], 400);
            }

            $event = json_decode($input, true);
            Log::info('Event data', ['event' => $event]);

            if ($event['event'] !== 'charge.success') {
                Log::warning('Unexpected event type', ['type' => $event['event']]);
                $user = User::find($event['data']['metadata']['user_id']);
                $user->notify(new PaymentFailedNotification('The payment could not be processed.'));
                return response()->json(['error' => 'Payment failed'], 400);
            }

            $metadata = $event['data']['metadata'];
            $user = User::find($metadata['user_id']);

            if ($metadata['type'] === 'proposal') {
                $this->handleProposalPayment($metadata, $user);
            } elseif ($metadata['type'] === 'session') {
                $this->handleSessionPayment($metadata, $user);
            } else {
                Log::warning('Unknown payment type', ['type' => $metadata['type']]);
                return response()->json(['error' => 'Unknown payment type'], 400);
            }

            $this->savePayment($event);
            Log::info('Payment processed successfully', ['event' => $event]);
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $exception) {
            Log::error('Payment callback error', ['message' => $exception->getMessage(), 'trace' => $exception->getTraceAsString()]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }