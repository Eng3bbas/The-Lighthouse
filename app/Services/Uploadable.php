<?php


namespace App\Services;


use Illuminate\Http\UploadedFile;

trait Uploadable
{
    protected function uploadImage(UploadedFile $file , string $dir) : string
    {
        $baseFileName = $file->hashName();
        $file->storeAs($dir,$baseFileName);
        return "$dir/$baseFileName";
    }
}
