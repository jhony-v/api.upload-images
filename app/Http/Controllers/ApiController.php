<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UploadImageRepository;


class ApiController extends Controller {


    private $uploadImage;

    
    public function __construct() {
        $this->uploadImage = new UploadImageRepository();
        $this->uploadImage->crop = 'limit';
        $this->uploadImage->width = 500;
        $this->uploadImage->useFilename = true;
    }
    
    
    public function upload(Request $request) {
        $allUrl = [];
        foreach ($request->file('images') as $currentImage) {
            $this->uploadImage->publicId = 'img-'.uniqid();
            $allUrl[] = $this->uploadImage->uploadImage($currentImage)['url'];
        }
        return $allUrl;
    }

    

}