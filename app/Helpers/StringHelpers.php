<?php

namespace App\Helpers;

function getFileExtension($filename): string
{
    $parts = explode('.', $filename);
    $numParts = count($parts);

    if ($numParts > 1) {
        return $parts[$numParts - 1];
    } else {
        return "No extension found";
    }
}


