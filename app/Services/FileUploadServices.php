<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadServices
{
    public static function uploadImage($file, $old_image = null, $directory = 'upload', $prefix = ''): string
    {
        $file_ext  = $file->getClientOriginalExtension();
        $directory = trim($directory, ' /,');
        //Check And Create Directory
        $disk = Storage::disk('public');
        if ( ! $disk->exists($directory)) {
            $disk->makeDirectory($directory);
        }
        $imageName = $prefix.date('ymdhisa').'-'.uniqid().'.'.$file_ext;

        $disk->put($directory.'/'.$imageName, $file->getContent());

        //Check And delete Old file
        if ($old_image && $disk->exists($directory.'/'.$old_image)) {
            $disk->delete($directory.'/'.$old_image);
        }

        return $imageName;
    }
}
