<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mensaje;
use App\Huesped;
use Carbon\Carbon;
use Exception;

class MensajeController extends Controller
{
    public function index() {
        try {
            $user = Auth::user();
            $huesped = Huesped::where('user_id', $user->id)->first();
            $condition = [
                'user_id' => $user->id,
            ];
            if ($huesped != null) {
                $condition['huesped_id'] = $huesped->id;
            }

            $contador=$this->contador("mensajeindex=");
            $mensajes = Mensaje::with('huesped')
                                // ->orWhere($condition)
                                ->get();
            // foreach ($mensajes as $mensaje) {
            //     $mensaje->by = $mensaje->by == 'U' ? 'Residencial' : 'Huesped';
            // }        
            // dd($mensajes);                    
            return view('src.mensaje.index', compact('mensajes', 'contador'));
        } catch (\Throwable $th) {
            $mensajes = [];
            $contador = 1;
            dd($th->getMessage());
            return view('src.mensaje.index', compact('mensajes', 'contador'))->with('error', $th->getMessage());
        }
    }

    public function create() {
        $huespeds = Huesped::all();
        $contador=$this->contador("mensajecreate=");
        return view('src.mensaje.create', compact('huespeds', 'contador'));
    }

    public function store(Request $request) {
        try {
            $user = Auth::user();
            $huesped = Huesped::where('user_id', $user->id)->first();
            $mensaje = Mensaje::create([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'huesped_id' => $request->huesped_id,
                'user_id' => $user->id,
                'fechahora' => Carbon::now()->toDateTimeString(),
                'by' => $huesped != null ? 'H' : 'U',
            ]);
            return redirect()->route('mensajes')->with('success', 'Se guardo correctamente el mensaje');
        } catch (\Throwable $th) {
            return redirect()->route('mensajes_create')->with('error', $th->getMessage());
        }
    }

    public function edit($id) {

        try {
            $mensaje = Mensaje::find($id);
            if ($mensaje == null) {
                return redirect()->route('mensajes')->with('error', 'El mensaje no existe');
            }
            $huespeds = Huesped::all();
            $contador=$this->contador("mensajeedit=");
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
