<?php 

namespace App\Business\UseCases;
use App\Data\Repositories\ImageRepository;

class UploadImageUseCase {
    public function __construct(protected ImageRepository $image_repository) {}

    public function execute(Int $index, string $file_name, $data): void {
       $image = $this->image_repository->make($index, $file_name, $data);

       $this->image_repository->insert($image);
    }
}