<?php

namespace App\Http\Controllers\Api;

use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequest;
use App\Services\Documents\CreateNewDocument\Contracts\ICreateNewDocumentService;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function store(CreateDocumentRequest $request, ICreateNewDocumentService $service)
    {
        try {
            $data = $request->all();
            $document = $service->handle($data);

            return ApiResponse::get(
                $document,
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            //
        }
    }
}
