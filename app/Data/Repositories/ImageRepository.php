<?php

namespace App\Data\Repositories;

use App\Data\Storages\S3ImageDataStorage;
use App\Data\Models\RootImage;
use App\Exceptions\ImageUploadFailedException;
use App\Models\ImageAccessInformation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ImageRepository {
    public function __construct(
        private S3ImageDataStorage $s3_image_data_storage
     ) {}

    public static function make(int $index, UploadedFile $data): RootImage {
        $create_result = new RootImage($data, $index);

        return $create_result;
    } 

    public function insert(RootImage $incoming_image): void {    
        $url = $this->s3_image_data_storage->insert($incoming_image);   
        if($url === null) {
            throw new ImageUploadFailedException(
                'Upload image file has failed. 
                Please check the generated report for more information.'
            );
        }
        
        ImageAccessInformation::create(['url' => strval($url), 'index' => intval($incoming_image->index)]);
    }

    public function retrieveAllUrlsAndIndices(): Array {
        $images_access_information = ImageAccessInformation::all();
        Log::debug($images_access_information);
        $urls_and_indices = $images_access_information->map(
            function ($access_information) {
                return [
                    'url' => $access_information->url, 
                    'index' => $access_information->index
                ];
        });

        return $urls_and_indices->toArray();
    }
}
