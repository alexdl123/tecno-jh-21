<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comentario;
use App\Huesped;
use Carbon\Carbon;
use Exception;

class ComentarioController extends Controller
{
    public function index() {
        try {
            $comentarios = Comentario::with('huesped')->get();
            $contador = $this->contador('comentarioindex=');
            return view('src.comentario.index', compact('comentarios', 'contador'));
        } catch (\Throwable $th) {
            $comentarios = [];
            $contador = 1;
            dd([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
            ]);
            return view('src.mensaje.index', compact('comentarios', 'contador'))->with('error', $th->getMessage());
        }
    }

    public function create() {
        $huespeds = Huesped::all();
        $contador = $this->contador('comentariocreate=');
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
            $comentario = Comentario::find($id);
            if ($comentario == null) {
                return redirect()->route('comentarios')->with('error', 'El comentario no existe');
            }
            $huespeds = Huesped::all();
            $contador = $this->contador('comentarioedit=');
            return view('src.comentario.edit', compact('comentario', 'contador', 'huespeds'));
        } catch (\Throwable $th) {
            return redirect()->route('comentarios')->with('error', $th->getMessage());
        }

    }

    public function update(Request $request, $id) {
        try {
            $comentario = Comentario::find($id);
            if ($comentario == null) {
                return redirect()->route('comentarios')->with('error', 'El comentario no existe');
            }

            $comentario->titulo = $request->titulo;
            $comentario->comentario = $request->comentario;
            $comentario->huesped_id = $request->huesped_id;
            $comentario->update();
            
            return redirect()->route('comentarios')->with('success', 'Se actualizo correctamente el comentario');
        } catch (\Throwable $th) {
            $comentario = Comentario::find($id);
            $huespeds = Huesped::all();
            $contador = 12;
            return redirect()->route('comentarios_edit', compact('comentario', 'contador', 'huespeds'))->with('error', $th->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $comentario = Comentario::find($id);
            if ($comentario == null) {
                return redirect()->route('comentarios')->with('error', 'El comentario no existe');
            }
            $comentario->delete();
            return redirect()->route('comentarios')->with('success', 'El comentario se elimino correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('comentarios')->with('error', $th->getMessage());
        }
    }

    public static function contador($valor){
        
        $contents = file_get_contents(storage_path('contadores.txt'));
        $new_contents= "";
        if( strpos($contents, $valor) !== false) { 
            $contents_array = preg_split("/\\r\\n|\\r|\\n/", $contents);
            foreach ($contents_array as &$record) {   
                if (strpos($record, $valor) !== false) { 
                    $pos = strpos($record, '=');
                    $nro = substr($record,$pos+1,strlen($record)-1);
                    $nuevoValor=($nro*1)+1;
                    $cadena = $valor.$nuevoValor."\r";
                    $new_contents .= $cadena; 
                }else{
                    $new_contents .= $record ."\r";
                }
            }
            $str = trim($new_contents);
            file_put_contents(storage_path('contadores.txt'),$str); 
        }
        else{
            //echo json_encode("doesn't exist!");
            throw new Exception('Contador no encontrado!');
        }
        return $nuevoValor;
    }
}
