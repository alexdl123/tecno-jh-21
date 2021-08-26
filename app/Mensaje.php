<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensaje';

    protected $fillable = [
        'titulo',
        'contenido',
        'fechahora',
        'by',
        'huesped_id',
        'user_id'
    ];

    public function huesped() {
        return $this->belongsTo(Huesped::class, 'huesped_id', 'id');
    }

}
