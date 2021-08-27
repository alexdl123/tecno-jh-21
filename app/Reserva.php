<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Reserva extends Model
{
    use SoftDeletes;
    protected $table = 'reserva';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $attributes = [ //atributos que tienen valores por defectos
        
    ];

    protected $fillable = [ // atributos del modelo
        'descripcion', 'huesped_id','promocion_id','user_id', 'fecha', 'fecha_ingreso','fecha_salida'
    ];

    public static function listado(){

        $huespedes = DB::table("reserva")
            ->select(['reserva.id','reserva.fecha_ingreso','reserva.fecha_salida','c.nombre','c.apellido'])
            ->leftJoin('huesped as c', 'reserva.huesped_id', '=', 'c.id')
            ->whereNull('reserva.deleted_at')
            ->get();
        
        return $huespedes;
    }

    public static function mislistado($id){

        $huespedes = DB::table("reserva")
            ->select(['reserva.id','reserva.fecha_ingreso','reserva.fecha_salida','c.nombre','c.apellido'])
            ->leftJoin('huesped as c', 'reserva.huesped_id', '=', 'c.id')
            ->where('c.id', '=',$id)
            ->whereNull('reserva.deleted_at')
            ->get();
        
        return $huespedes;
    }
}
