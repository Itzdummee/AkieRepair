<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class CloudinaryService
{
    public function upload(UploadedFile $file, string $folder, ?string $publicId = null): string
    {
        $cloudName = config('services.cloudinary.cloud_name');
        $apiKey = config('services.cloudinary.api_key');
        $apiSecret = config('services.cloudinary.api_secret');

        if (! $cloudName || ! $apiKey || ! $apiSecret) {
            throw new RuntimeException('Cloudinary credentials are not configured.');
        }

        $parameters = array_filter([
            'folder' => trim($folder, '/'),
            'overwrite' => 'true',
            'public_id' => $publicId,
            'timestamp' => time(),
        ], fn ($value) => $value !== null && $value !== '');

        ksort($parameters);
        $signature = sha1(urldecode(http_build_query($parameters)).$apiSecret);

        $response = Http::asMultipart()
            ->attach('file', fopen($file->getRealPath(), 'r'), $file->getClientOriginalName())
            ->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
                ...$parameters,
                'api_key' => $apiKey,
                'signature' => $signature,
            ]);

        if ($response->failed() || ! $response->json('secure_url')) {
            throw new RuntimeException('Cloudinary upload failed: '.$response->json('error.message', $response->body()));
        }

        return $response->json('secure_url');
    }
}
