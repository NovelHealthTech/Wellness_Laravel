<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    /**
     * Upload a file to the given folder in local storage
     *
     * @param \Illuminate\Http\UploadedFile|null $file
     * @param string $folder
     * @return string|null
     */
    function uploadFile($file, $folder)
    {
        if (!$file) {
            return null;
        }

        $name = time() . "_" . uniqid() . '.' . $file->getClientOriginalExtension();

        if (!Storage::disk('local')->exists($folder . '/' . $name)) {
            $path = $file->storeAs($folder, $name, 'public');
        } else {
            $path = $folder . '/' . $name;
        }

        return $path;
    }
}
