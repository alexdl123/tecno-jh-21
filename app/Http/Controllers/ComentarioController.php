<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comentario;
use App\Huesped;
use Carbon\Carbon;

class ComentarioController extends Controller
{
    public function index() {
        try {
            $comentarios = Comentario::with('huesped')->orderBy('id', 'desc')->get();
            $contador = 15;                 
            return view('src.comentario.index', compact('comentarios', 'contador'));
        } catch (\Throwable $th) {
            $comentarios = [];
            $contador = 1;
            dd($th->getMessage());
            return view('src.mensaje.index', compact('comentarios', 'contador'))->with('error', $th->getMessage());
        }
    }

    public function create() {
        $huespeds = Huesped::all();
        $contador = 12;
        return view('src.comentario.create', compact('huespeds', 'contador'));
    }

    public function store(Request $request) {
        try {
            
            $comentario = Comentario::create([
                'titulo' => $request->titulo,
                'comentario' => $request->comentario,
                'huesped_id' => $request->huesped_id,
                'fechahora' => Carbon::now()->toDateTimeString(),
            ]);
            return redirect()->route('comentarios')->with('success', 'Se guardo correctamente el comentario');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $comentarios = [];
            $contador = 12;
            return redirect()->route('comentarios_create', compact('comentarios', 'contador'))->with('error', $th->getMessage());
        }
    }

    public function edit($id) {

        try {
            $mensaje = Mensaje::find($id);
            if ($mensaje == null) {
                return redirect()->route('mensajes')->with('error', 'El mensaje no existe');
            }
            $huespeds = Huesped::all();
            $contador = 12;
            return view('src.mensaje.edit', compact('mensaje', 'contador', 'huespeds'));
        } catch (\Throwable $th) {
            return redirect()->route('mensajes')->with('error', $th->getMessage());
        }

    }

    public function update(Request $request, $id) {
        try {
            $mensaje = Mensaje::find($id);
            if ($mensaje == null) {
                return redirect()->route('mensajes')->with('error', 'El mensaje no existe');
            }

            $mensaje->titulo = $request->titulo;
            $mensaje->contenido = $request->contenido;
            $mensaje->huesped_id = $request->huesped_id;
            $mensaje->update();
            
            return redirect()->route('mensajes')->with('success', 'Se actualizo correctamente el mensaje');
        } catch (\Throwable $th) {
            $mensaje = Mensaje::find($id);
            $huespeds = Huesped::all();
            $contador = 12;
            return redirect()->route('mensajes_edit', compact('mensaje', 'contador', 'huespeds'))->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $mensaje = Mensaje::find($id);
            if ($mensaje == null) {
                return redirect()->route('mensajes')->with('error', 'El mensaje no existe');
            }
            $mensaje->delete();
            return redirect()->route('mensajes')->with('success', 'El mensaje se elimino correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('mensajes')->with('error', $th->getMessage());
        }
    }
}
