<?php

namespace App\Data\Storages;

use Throwable;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Log;
use App\Data\Models\RootImage as ImageFile;

class S3ImageDataStorage {    
    public function __construct(
        private FileSystemAdapter $s3
     ) {}

    public function insert(ImageFile $file): ?string {
        try{
            $insert_result = $this->s3->put(strval($file->index), $file->data);
            if(!$insert_result) {
                return null;
            }

            return $this->s3->url($insert_result);
        } catch(Throwable $exception) {
            Log::error($exception);

            return null;
        }
    }
}