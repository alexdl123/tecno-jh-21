<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Huesped extends Model
{
    use SoftDeletes;
    protected $table = 'huesped';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    
    protected $fillable = [ // atributos del modelo
        'nombre','apellido', 'fecha','telefono','ci','user_id'
    ];

    public static function listado(){

        $huespedes = DB::table("huesped")
            ->select([
                'huesped.id','huesped.nombre','huesped.apellido','huesped.telefono',
                'u.email', 'hh.estado', 'h.nrohabitacion'])
            ->leftJoin('users as u', 'huesped.user_id', '=', 'u.id')
            ->leftJoin('habitacion_huesped as hh', function($q) {
                $q->on('huesped.id', 'hh.huesped_id')
                ->leftJoin('habitaciones as h', 'h.id', 'hh.habitacion_id')
                ->where('hh.estado', 'A');
            })
            // ->leftJoin('habitacion_huesped as hh', 'huesped.id', 'hh.huesped_id')
            // ->where('hh.estado', 'A')
            ->whereNull('huesped.deleted_at')
            ->get();
        
        return $huespedes;
    }

    public static function getHuesped($id){

        $huespedes = DB::table("huesped")
            ->select(['huesped.id','huesped.nombre','huesped.apellido','huesped.telefono','u.email'])
            ->leftJoin('users as u', 'huesped.user_id', '=', 'u.id')
            ->where('u.id','=',$id)
            ->whereNull('huesped.deleted_at')
            ->get();
        
        return $huespedes[0];
    }
}
