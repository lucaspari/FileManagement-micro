<?php

namespace App\Services;

use App\Models\File;
use App\Models\FileType;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FileService
{

    /**
     * @throws Exception
     */
    public function insert($request): Model|Builder
    {
        if (!$request->hasFile('file')) {
            throw new Exception("Missing file on your request");
        }
        $file = $request->file('file');
        $details = $request->input('details');
        $fileExtension = $this->getFileExtension($file->getClientOriginalName());
        $fileType = FileType::query()->where("name", $fileExtension)->firstOrCreate(["name" => $fileExtension]);
        return File::query()->create(["name" => $file->getClientOriginalName(), "format" => $fileType->getKey(), "details" => $details, "size" => $file->getSize(),]);
    }

    // probably should be in a helper file
    protected function getFileExtension($filename): string
    {
        $parts = explode('.', $filename);
        $numParts = count($parts);
        if ($numParts > 1) {
            return $parts[$numParts - 1];
        } else {
            return "No extension found";
        }
    }

}
