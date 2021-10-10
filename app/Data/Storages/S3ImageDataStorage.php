<?php

namespace App\Data\Storages;

use Throwable;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Data\Models\RootImage as ImageFile;

class S3ImageDataStorage {    
    public function __construct(
        private string $disk
     ) {}

    public function insert(ImageFile $file): ?string {
        try{
            $s3_url = Storage::disk($this->disk)->put($file->s3_key, $file->data);
            
            return $s3_url;
        } catch(Throwable $exception) {
            Log::error($exception);

            return null;
        }
    }
}