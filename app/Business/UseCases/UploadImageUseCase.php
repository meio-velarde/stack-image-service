<?php 

namespace App\Business\UseCases;
use App\Data\Repositories\ImageRepository;
use Illuminate\Http\UploadedFile;

class UploadImageUseCase {
    public function __construct(private ImageRepository $image_repository) {}

    public function execute(int $index, UploadedFile $data): void {
       $image = $this->image_repository->make($index, $data);

       $this->image_repository->insert($image);
    }
}