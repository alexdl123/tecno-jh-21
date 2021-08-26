<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresoSalida extends Model
{
    
    protected $table = 'ingreso_salida';

    protected $fillable = [
        'fecha_hora',
        'type',
        'nota',
        'habitacion_huesped_id',
    ];

    public function habitacionHuesped() {
        return $this->belongsTo(HabitacionHuesped::class, 'habitacion_huesped_id', 'id');
    }

}
