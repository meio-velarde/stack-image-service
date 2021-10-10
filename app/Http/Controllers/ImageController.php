<?php 

namespace App\Http\Controllers;

use Throwable;
use App\Business\UseCases\RetrieveAllUrlsAndIndicesUseCase;
use App\Business\UseCases\UploadImageUseCase;
use App\Exceptions\ImageUploadFailedException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller {
    public function __construct(
        private RetrieveAllUrlsAndIndicesUseCase $retrieve_all_images_use_case,
        private UploadImageUseCase $upload_image_use_case
        ) {}

    public function index():JsonResponse
    {   
        $retrieve_result = $this->retrieve_all_images_use_case->execute();

        return response()->json($retrieve_result);
    }

    public function store(Request $request):Response
    {
        $bad_request_condition = 
            !$request->hasFile('data') || 
            !$request->exists('index');

        if($bad_request_condition) {
            return response(
                'Invalid storage request, please make sure the data, file_name, and index parameters have been filled',
                 403
            );
        }

        try {
            $data = $request->file('data');
            $index = $request->input('index');

            $this->upload_image_use_case->execute($index, $data);
        } catch (Throwable $exception) {
            if($exception instanceof ImageUploadFailedException) {
                Log::error($exception);
                abort(500, 'Image upload failed.');
            }
        }

        return response('', 200);
    }
}