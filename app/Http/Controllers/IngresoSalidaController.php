<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IngresoSalida;
use App\HabitacionHuesped;

class IngresoSalidaController extends Controller
{
    public function index() {
        $contador = 11;
        $datos = IngresoSalida::with(['habitacionHuesped.habitacion', 'habitacionHuesped.huesped'])->get();
        // dd($datos);
        return view('src.ingreso_salida.index', compact('datos', 'contador'));
    }

    public function create($id) {
        $contador = 10;
        return view('src.ingreso_salida.create', compact('contador', 'id'));
    }

    public function store(Request $request) {
        try {
            $habitacionHuesped = HabitacionHuesped::where('huesped_id', $request->id)->first();
            $ingresoSalida = IngresoSalida::create([
                'fecha_hora' => $request->fecha . ' ' . $request->hora,
                'type' => $request->type,
                'nota' => $request->nota,
                'habitacion_huesped_id' => $habitacionHuesped['id'],
            ]);
            $text = $request->type == 'I' ? 'Ingreso' : 'Salida';
            return redirect()->route('huespedes')->with('success', 'Registro de ' . $text . ' exitoso!');
        } catch (\Throwable $th) {
            $contador = 10;
            $id = $request->id;
            return redirect()->route('ingreso_salida_create', compact('contador', 'id'))->with('error', $th->getMessage());
        }
    }


}
