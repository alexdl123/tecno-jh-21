<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rol extends Model
{
    public static function getRoles(){

        return  DB::table("roles")
            ->where('roles.id','!=', 3)
            ->get();
        
    }
}
