<?php

namespace App\Data\Repositories;

use App\Data\Storages\S3ImageDataStorage;
use App\Data\Models\RootImage;
use App\Data\Storages\Models\ImageAccessInformation;
use App\Exceptions\ImageUploadFailedException;

class ImageRepository {
    public function __construct(
        private readonly S3ImageDataStorage $s3_image_data_storage
     ) {
        $this->s3_image_data_storage = $s3_image_data_storage;
    }

    public static function make(int $index, string $file_name, $data): RootImage {
        $s3_key = $index. '/' . $file_name;
        $create_result = new RootImage($data, $s3_key, $index);

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

        ImageAccessInformation::factory()->create([
            'url' => strval($url),
            'index' => intval($incoming_image->index)
        ]);
    }

    public function retrieveAllUrlsAndIndices(): Array {
        $images_access_information = ImageAccessInformation::all();
            
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
