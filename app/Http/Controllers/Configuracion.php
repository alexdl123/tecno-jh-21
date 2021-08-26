<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Exception;

class Configuracion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("configuracion=");
        return view('src.configuracion.index', compact('contador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fuente(Request $request)
    {
        //$request->input('fuente');
        try {
            $user = User::find(Auth::user()->id);
            if ($user && $request->fuente != '') {
                $user->tipo_letra = $request->fuente;
                $user->update();
                //Bitacora::store('fuente', 'user');
                DB::commit();
                return redirect()->route('configuraciones')->with('success', 'Fuente cambiada exitosamente!');
            } else {
                throw new Exception('Solicitud no encontrada!');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('configuraciones')->with('error', 'Datos incorrectos!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tamano(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            if ($user && $request->tamano != '') {
                $user->tamano = $request->tamano;
                $user->update();
                //Bitacora::store('tamano', 'user');
                DB::commit();
                return redirect()->route('configuraciones')->with('success', 'Tamaño cambiado exitosamente!');
            } else {
                throw new Exception('Solicitud no encontrada!');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('configuraciones')->with('error', 'Datos incorrectos!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tema(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            if ($user && $request->tema != '') {
                $user->tema = $request->tema;
                $user->update();
                //Bitacora::store('tema', 'user');
                DB::commit();
                return redirect()->route('configuraciones')->with('success', 'Tema cambiado exitosamente!');
            } else {
                throw new Exception('Solicitud no encontrada!');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('configuraciones')->with('error', 'Datos incorrectos!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
