<?php

namespace App\Services;

use App\Models\File;
use App\Models\FileType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class FileService
{

    public function insert(array|UploadedFile|null $file): Model|Builder
    {
        $fileExtension = $this->getFileExtension($file->getClientOriginalName());
        $fileType = FileType::query()->where("name", $fileExtension)->firstOrCreate(["name" => $fileExtension]);
        return File::query()->create(["name" => $file->getClientOriginalName(), "format" => $fileType->getKey(), "size" => $file->getSize(),]);
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
