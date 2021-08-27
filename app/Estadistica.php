<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estadistica extends Model
{
    public static function get_actividades()
    {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $year = now()->year;

        $datos = DB::select("select count(id) as cant, date_part('month', created_at) as mes from bitacora where date_part('year', created_at) = $year group by date_part('month', created_at)");
        $datos_array = array();
        for ($i = 0; $i < count($meses); $i++) {
            $inside = false;
            for ($e = 0; $e < count($datos); $e++) {
                if ($datos[$e]->mes == $i + 1) {
                    $new = array('y' => $meses[$i], 'a' => $datos[$e]->cant);
                    array_push($datos_array, $new);
                    $inside = true;
                }
            }
            if (!$inside) {
                $new = array('y' => $meses[$i], 'a' => 0);
                array_push($datos_array, $new);
            }
        }
        return $datos_array;
    }

    public static function get_huespedes()
    {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $year = now()->year;

        $datos = DB::select("select count(id) as cant, date_part('month', created_at) as mes from huesped where date_part('year', created_at) = $year group by date_part('month', created_at)");
        $datos_array = array();
        for ($i = 0; $i < count($meses); $i++) {
            $inside = false;
            for ($e = 0; $e < count($datos); $e++) {
                if ($datos[$e]->mes == $i + 1) {
                    $new = array('y' => $meses[$i], 'a' => $datos[$e]->cant);
                    array_push($datos_array, $new);
                    $inside = true;
                }
            }
            if (!$inside) {
                $new = array('y' => $meses[$i], 'a' => 0);
                array_push($datos_array, $new);
            }
        }
        return $datos_array;
    }

    public static function get_reservas()
    {
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $year = now()->year;

        $datos = DB::select("select count(id) as cant, date_part('month', fecha_ingreso) as mes from reserva where date_part('year', fecha_ingreso) = $year group by date_part('month', fecha_ingreso)");
        $datos_array = array();
        for ($i = 0; $i < count($meses); $i++) {
            $inside = false;
            for ($e = 0; $e < count($datos); $e++) {
                if ($datos[$e]->mes == $i + 1) {
                    $new = array('y' => $meses[$i], 'a' => $datos[$e]->cant);
                    array_push($datos_array, $new);
                    $inside = true;
                }
            }
            if (!$inside) {
                $new = array('y' => $meses[$i], 'a' => 0);
                array_push($datos_array, $new);
            }
        }
        return $datos_array;
    }
}
