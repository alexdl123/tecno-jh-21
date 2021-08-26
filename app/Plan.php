<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Plan extends Model
{
    use SoftDeletes;
    protected $table = 'opciones';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $guarded;
    
    protected $fillable = [ // atributos del modelo
        'nombre', 'fecha'
    ];

    public static function listado(){
        return DB::table('opciones')
                ->whereNull('deleted_at')
                ->get();
    }
}
