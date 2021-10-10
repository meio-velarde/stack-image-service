<?php 

namespace App\Business\UseCases;
use App\Data\Repositories\ImageRepository;

class RetrieveAllUrlsAndIndicesUseCase {
    public function __construct(private readonly ImageRepository $image_repository) {}

    public function execute(): Array {
        return $this->image_repository->retrieveAllUrlsAndIndices();
    }
}