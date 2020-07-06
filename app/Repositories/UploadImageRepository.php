<?php

namespace App\Repositories;

use \Cloudinary;
use \Cloudinary\Uploader;

class UploadImageRepository
{

    public $width;
    public $useFilename;
    public $crop;
    public $publicId;

    public function __construct()
    {
        Cloudinary::config([
            'cloud_name' => env('CLOUD_NAME'),
            'api_key' => env('API_KEY'),
            'api_secret' => env('API_SECRET'),
            'secure' => env('SECURE')
        ]);
    }

    private function properties()
    {
        $properties = array(
            'width' => $this->width,
            'use_filename' => $this->useFilename,
            'crop' => $this->crop,
            'public_id' => $this->publicId,
        );
        return $properties;
    }

    private function createImageBase64($pathImage)
    {
        $base = 'data:image/png;base64,';
        $dataImage = base64_encode(file_get_contents($pathImage));
        return $base . $dataImage;
    }

    public function uploadImage($image)
    {
        $image = Uploader::upload(
            $this->createImageBase64($image),
            $this->properties()
        );
        return $image;
    }

    public function deleteImage($public_id_image)
    {
        $imageDeleted = Uploader::destroy($public_id_image);
        return $imageDeleted;
    }
}
