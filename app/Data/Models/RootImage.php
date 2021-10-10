<?php 

namespace App\Data\Models;

class RootImage {
    public function __construct(
        public ?string $data = null,
        public ?string $s3_key = null,
        public ?int $index = null,
        public ?string $url = null,
    ) {}
}