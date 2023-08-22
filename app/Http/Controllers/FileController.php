<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function App\Helpers\getFileExtension;

class FileController extends Controller
{
   function addFile(Request $request): \Illuminate\Http\JsonResponse
   {
           try{

                $file = $request->file('file');
                $fileExtension = getFileExtension($file->getClientOriginalName());
                dd($fileExtension);
                return response()->json([
                    'message' => 'File uploaded successfully',
                    'extension' => $fileExtension
                ], 200);
              }catch(\Exception $e){
                return response()->json([
                    'message' => 'Error uploading file',
                    'error' => $e->getMessage()
                ], 500);
              }
    }
}
