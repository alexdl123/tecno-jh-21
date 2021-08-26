<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class DetalleReserva extends Model
{
    use SoftDeletes;
    protected $table = 'det_reserva';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $attributes = [ //atributos que tienen valores por defectos
        
    ];

    protected $fillable = [ // atributos del modelo
        'habitacion_id', 'reserva_id', 'fecha'
    ];

    public static function listado($id){

        $huespedes = DB::table("det_reserva")
            ->select(['det_reserva.id','det_reserva.fecha','c.nrohabitacion','ca.nombre'])
            ->leftJoin('habitaciones as c', 'det_reserva.habitacion_id', '=', 'c.id')
            ->leftJoin('categoria as ca', 'c.categoria_id', '=', 'ca.id')
            ->where('det_reserva.reserva_id','=',$id)
            ->whereNull('det_reserva.deleted_at')
            ->get();
        
        return $huespedes;
    }
}
