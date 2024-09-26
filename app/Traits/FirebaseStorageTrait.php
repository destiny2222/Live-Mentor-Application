<?php

namespace App\Traits;

use App\Models\Plugin;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;

trait FirebaseStorageTrait
{
    protected function firebaseStorage()
    {
        $firebaseCredentials = Plugin::first();
        if (!$firebaseCredentials) {
            throw new Exception('Firebase credentials not found.');
        }

        try {
            $factory = (new Factory)
                ->withServiceAccount([
                    'type' => 'service_account',
                    'project_id' => $firebaseCredentials->project_id,
                    'private_key_id' => $firebaseCredentials->private_key_id,
                    'private_key' => str_replace("\\n", "\n", $firebaseCredentials->private_key),
                    'client_email' => $firebaseCredentials->client_email,
                    'client_id' => $firebaseCredentials->client_id,
                    'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                    'token_uri' => 'https://oauth2.googleapis.com/token',
                    'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                    'client_x509_cert_url' => $firebaseCredentials->client_x509_cert_url,
                    'universe_domain' => 'googleapis.com',
                ]);

            return $factory->createStorage()->getBucket();
        } catch (Exception $e) {
            throw new Exception('Could not connect to Firebase: ' . $e->getMessage());
        }
    }

    public function uploadFileToFirebase($file, $directory = 'uploads/')
    {
        $bucket = $this->firebaseStorage();
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $path = $directory . $fileName;

        try {
            // Check if the file is an image or document (PDF, DOC, DOCX)
            $fileMimeType = $file->getMimeType();

            if (str_starts_with($fileMimeType, 'image/')) {
                // It's an image, resize it using Intervention Image
                $manager = new ImageManager();
                $image = $manager->read($file->getRealPath());
                $image->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Save the resized image to a temporary file
                $tempFilePath = tempnam(sys_get_temp_dir(), 'firebase_image');
                $image->save($tempFilePath);
            } else {
                // For non-image files like PDF, DOC, DOCX, directly upload the file
                $tempFilePath = $file->getRealPath();
            }

            // Upload the file (image, PDF, or DOC) to Firebase Storage
            $bucket->upload(
                fopen($tempFilePath, 'r'),
                [
                    'name' => $path,
                ]
            );

            // Delete the temporary file if it was an image
            if (str_starts_with($fileMimeType, 'image/')) {
                unlink($tempFilePath);
            }

            // Construct the public URL
            $storageUrl = sprintf(
                'https://firebasestorage.googleapis.com/v0/b/%s/o/%s?alt=media',
                $bucket->name(),
                urlencode($path)
            );

            return $storageUrl;
        } catch (Exception $e) {
            throw new Exception('File upload failed: ' . $e->getMessage());
        }
    }
}
