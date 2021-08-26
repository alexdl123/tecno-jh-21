<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("bitacoraindex=");
        $bitacora= Bitacora::listado();
        Bitacora::store('listar', 'bitacoras');
        return view('src.bitacora.index', compact('contador', 'bitacora'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
