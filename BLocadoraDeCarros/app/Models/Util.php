<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    use HasFactory;

    public static function saveImage($image, $description, $namePath)
    {
        $folder = str_replace([' ', '-','\\','/',':','*','?','"','<','>','|','+','.',',',
        '@','#','$','&','=',';'], '_', mb_strtoupper($description, 'UTF-8'));
        $path   = "images/$namePath/$folder";
        return $image->store($path, 'public');
    }
}
