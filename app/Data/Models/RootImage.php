<?php 

namespace App\Data\Models;

use Illuminate\Http\UploadedFile;

class RootImage {
    public function __construct(
        public ?UploadedFile $data = null,
        public ?int $index = null,
        public ?string $url = null,
    ) {}
}