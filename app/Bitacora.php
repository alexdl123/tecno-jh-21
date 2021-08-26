<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Bitacora extends Model
{
    use SoftDeletes;
    protected $table = 'bitacora';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    protected $fillable = [ // atributos del modelo
        'tabla', 'accion', 'fecha', 'user_id'
    ];

    public static function listado(){

        $bitacoras = Bitacora::all();
        foreach ($bitacoras as $bitacora) {
            $usuario = User::find($bitacora->user_id);
            if ($usuario) {
                $bitacora->usuario = $usuario->name;
            }
        }
        return $bitacoras;
    }

    public static function store($accion, $tabla)
    {
        $mytime = Carbon::now('America/La_paz');
        $fecha = $mytime->toDateString();

        $bitacora = new Bitacora();
        $bitacora->accion = $accion;
        $bitacora->tabla = $tabla;
        $bitacora->user_id = Auth::user()->id;
        $bitacora->fecha = $fecha;
        $bitacora->created_at = now();
        $bitacora->save();
    }
}
