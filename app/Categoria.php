<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $attributes = [ //atributos que tienen valores por defectos
        
    ];

    protected $fillable = [ // atributos del modelo
        'descripcion', 'nombre', 'fecha', 'img'
    ];

    public static function listado(){
        return DB::table('categoria')
                ->whereNull('deleted_at')
                ->get();
    }
}
