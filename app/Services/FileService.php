<?php

namespace App\Services;

use App\Models\File;
use App\Models\FileType;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        Storage::disk('local')->put($file->getClientOriginalName(), $file->get());
        return File::query()->create(["name" => $file->getClientOriginalName(), "format" => $fileType->getKey(), "details" => $details, "size" => $file->getSize(),]);
    }

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

    // probably should be in a helper file

    public function makePDF(string $format): \Barryvdh\DomPDF\PDF
    {

        $fileType = FileType::query()->where("name", $format)->first();
        $files = File::with('fileType')->where("format", $fileType->id)->get();
        for ($i = 0; $i < count($files); $i++) {
            $files[$i]->format = $fileType->name;
        }
        return PDF::loadView('pdf.files', compact('files'));
    }

}
