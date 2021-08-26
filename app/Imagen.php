<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    public static function getBase64($imagen)
    {
        $path = $imagen->getRealPath();
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}
