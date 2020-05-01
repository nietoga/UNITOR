<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorage implements ImageStorage
{
    public function store($request)
    {
        if ($request->hasFile('profile_image')) {
            Storage::disk('public')->put("profile-photos/user".$request['user_id'].".png", file_get_contents($request->file('profile_image')->getRealPath()));
        }
    }
}
