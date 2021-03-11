<?php

namespace App\Traits;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

trait UploadImage
{
    public static function upload($image, $folder)
    {
       $image = cloudinary()->upload($image, ["folder"=>"MY_WEARS/".$folder])->getSecurePath();
//       $image = cloudinary()->upload($image->getRealPath(), ["folder"=>"MY_WEARS/".$folder])->getSecurePath();
//        $save = Cloudinary::upload($image, null, ["folder"=>"my_wears/".$folder]);
        Log::debug(">>>>>>>>>>> nnnneeeee" . $image);
        return $image;
    }
}
