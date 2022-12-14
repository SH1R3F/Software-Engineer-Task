<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait UploadAvatar
{
    /**
     * Upload the given file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        // Upload avatar
        $avatar = $file->store('avatars', ['disk' => 'public']);
        return "storage/$avatar";
    }

    // Here goes the rest of my functions, like deleting or move or rename ...
}
