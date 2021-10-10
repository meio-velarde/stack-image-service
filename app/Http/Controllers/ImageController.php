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
        private readonly RetrieveAllUrlsAndIndicesUseCase $retrieve_all_images_use_case,
        private readonly UploadImageUseCase $upload_image_use_case
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
            !$request->exists('file_name') || 
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
            $file_name = $request->input('file_name');

            $this->upload_image_use_case->execute($index, $file_name, $data);
        } catch (Throwable $exception) {
            if($exception instanceof ImageUploadFailedException) {
                Log::error($exception);
                abort(500, 'Image upload failed.');
            }
        }

        return response('', 200);
    }
}