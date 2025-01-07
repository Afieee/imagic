<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImageService
{
    private $apyhubToken;
    private $hashtagApiKey;

    public function __construct()
    {
        $this->apyhubToken = env('APYHUB_API_TOKEN');
        $this->hashtagApiKey = env('HASHTAG_API_KEY');
    }

    public function addWatermark($imagePath, $watermarkPath)
    {
        $url = 'https://api.apyhub.com/processor/image/watermark/file?output=test-sample&preserve_format=true';
        $response = Http::withHeaders([
            'apy-token' => $this->apyhubToken,
        ])->attach('image', file_get_contents($imagePath), 'image.jpg')
            ->attach('watermark_image', file_get_contents($watermarkPath), 'watermark.jpg')
            ->post($url);

        if ($response->failed()) {
            throw new \Exception('Error adding watermark: ' . $response->body());
        }

        return $response->body(); // Returns the watermarked image binary
    }

    public function getMetadata($imagePath)
    {
        $url = 'https://api.apyhub.com/processor/image/metadata/file';
        $response = Http::withHeaders([
            'apy-token' => $this->apyhubToken,
        ])->attach('image', file_get_contents($imagePath), 'image.jpg')
            ->post($url);

        if ($response->failed()) {
            throw new \Exception('Error retrieving metadata: ' . $response->body());
        }

        return $response->json();
    }

    public function generateHashtags($imagePath)
    {
        $url = 'https://hashtag5.p.rapidapi.com/api/v2.1/tag/generate';
        $base64Image = base64_encode(file_get_contents($imagePath));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-RapidAPI-Host' => 'hashtag5.p.rapidapi.com',
            'X-RapidAPI-Key' => $this->hashtagApiKey,
        ])->post($url, [
            'image' => $base64Image,
        ]);

        if ($response->failed()) {
            throw new \Exception('Error generating hashtags: ' . $response->body());
        }

        return $response->json();
    }
}
