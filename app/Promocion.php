<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Promocion extends Model
{
    use SoftDeletes;
    protected $table = 'promocion';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $guarded;
    
    protected $fillable = [ // atributos del modelo
        'nombre', 'fecha', 'porcentaje'
    ];

    public static function listado(){
        return DB::table('promocion')
                ->whereNull('deleted_at')
                ->get();
    }
}
