<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HabitacionHuesped extends Model
{
    protected $table = 'habitacion_huesped';

    protected $fillable = [
        'nota',
        'fecha_hora_ingreso',
        'fecha_hora_salida',
        'estado',
        'habitacion_id',
        'huesped_id',
    ];
    
    public function habitacion() {
        return $this->belongsTo(Habitacion::class, 'habitacion_id', 'id');
    }

    public function huesped() {
        return $this->belongsTo(Huesped::class, 'huesped_id', 'id');
    }

}
