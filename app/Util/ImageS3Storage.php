<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Illuminate\Support\Facades\Storage;

class ImageS3Storage implements ImageStorage
{
    public function store($request)
    {
        if ($request->hasFile('profile_image')) {
            Storage::disk('s3')->put("profile-photos/user".$request['user_id'].".png", file_get_contents($request->file('profile_image')->getRealPath()));
        }
    }
}