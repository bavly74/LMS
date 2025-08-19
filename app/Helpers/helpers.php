<?php

use Illuminate\Support\Str;

if(! function_exists('upload_file') ) {
    function upload_file($file, $folder): string
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::random().'.'.$extension;
        $file->storeAs("{$folder}",$fileName,'public');
        return $path = "/{$folder}/{$fileName}";
    }
}
