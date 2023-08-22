<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    function addFile(Request $request): JsonResponse
    {
        try {
            $file = $this->fileService->insert($request);
            return response()->json(['message' => 'File uploaded successfully', 'file' => $file

            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error uploading file', 'error' => $e->getMessage()], 400);
        }
    }
}
