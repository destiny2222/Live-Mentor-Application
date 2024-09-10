<?php

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Tes\LaravelGoogleDriveStorage\GoogleDriveService;

function uploadImageToGoogleDrive($file)
{

    $response = GoogleDriveService::uploadFile($file);
    dd("File uploaded with ID: " . $response->id);

    // $client = new Client();
    // $client->setClientId(config('services.google_drive.CLIENT_ID'));
    // $client->setClientSecret(config('services.google_drive.CLIENT_SECRET'));
    // $client->setAccessType('offline');
    // $client->setScopes([Drive::DRIVE_FILE]);
    // $client->fetchAccessTokenWithRefreshToken(config('services.google_drive.REFRESH_TOKEN'));
    // $accessToken = $client->fetchAccessTokenWithRefreshToken(config('services.google_drive.REFRESH_TOKEN'));

    // // Set the access token for the client
    // $client->setAccessToken($accessToken);
    // if ($client->isAccessTokenExpired()) {
    //     $client->fetchAccessTokenWithRefreshToken(config('services.google_drive.REFRESH_TOKEN'));
    // }
    // dd($client);
    // $driveService = new Drive($client);

    // // Metadata for the file to be uploaded
    // $fileMetadata = new DriveFile([
    //     'name' => $file->getClientOriginalName(),
    //     // 'parents' => [config('GOOGLE_DRIVE_FOLDER_ID')] // Optional, if you want to upload to a specific folder
    // ]);

    // $content = file_get_contents($file);

    // Upload the file
    // $file = $driveService->files->create($fileMetadata, [
    //     'data' => $content,
    //     'mimeType' => $file->getClientMimeType(),
    //     'uploadType' => 'multipart',
    //     'fields' => 'id'
    // ]);

    // // Make the file publicly accessible
    // $fileId = $file->id;
    // $driveService->permissions->create($fileId, new Drive\Permission([
    //     'type' => 'anyone',
    //     'role' => 'reader',
    // ]));

    // // Return the public URL
    // return "https://drive.google.com/uc?id={$fileId}";
}
