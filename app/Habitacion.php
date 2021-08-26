<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Habitacion extends Model
{
    use SoftDeletes;
    protected $table = 'habitaciones';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    
    protected $fillable = [ // atributos del modelo
        'nrohabitacion','descripcion', 'fecha','estado','categoria_id'
    ];

    public static function listado() {

        $huespedes = DB::table("habitaciones")
            ->select(['habitaciones.id','habitaciones.estado','habitaciones.descripcion','c.nombre','habitaciones.nrohabitacion'])
            ->leftJoin('categoria as c', 'habitaciones.categoria_id', '=', 'c.id')
            ->whereNull('habitaciones.deleted_at')
            ->get();
        
        return $huespedes;
    }
}
