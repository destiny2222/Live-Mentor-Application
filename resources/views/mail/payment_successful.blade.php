<!-- resources/views/emails/payment_successful.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 10px; text-align: center; }
        .content { margin: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #6c757d; }
        .button { background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment Successful</h1>
        </div>
        <div class="content">
            <p>Your payment has been successfully processed.</p>
            <p><strong>Amount:</strong> {{ $amount }}</p>
            <p><strong>Status:</strong> {{ $status }}</p>
            <a href="{{ $dashboardUrl }}" class="button">View Dashboard</a>
        </div>
        <div class="footer">
            <p>Thank you for using our application!</p>
        </div>
    </div>
</body>
</html>
