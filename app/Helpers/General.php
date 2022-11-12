<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

function uploadImage($folder, $image)
{
    $filename = $image->hashName();
    $path2 = base_path("images/".$folder);
    $image->move($path2,$filename);
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}

