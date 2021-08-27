<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';

    protected $fillable = [
        'titulo',
        'comentario',
        'fechahora',
        'huesped_id'
    ];

    public function huesped() {
        return $this->belongsTo(Huesped::class, 'huesped_id', 'id');
    }
}
