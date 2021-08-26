<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Promocion;
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use Exception;
class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("promocionindex=");
        $promocion= Promocion::listado();
        Bitacora::store('listar', 'promociones');
        return view('src.promocion.index', compact('contador', 'promocion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contador=$this->contador("promocioncreate=");
        return view('src.promocion.create', compact('contador'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if((!empty($request->nombre_promocion)) && (!empty($request->porcentaje_promocion)))
            {
                $mytime = Carbon::now('America/La_paz');
                $fecha = $mytime->toDateString();
               
                Promocion::create([
                    'porcentaje' => $request->porcentaje_promocion,
                    'nombre' => $request->nombre_promocion,
                    'fecha' => $fecha
                ]);
                Bitacora::store('registrar', 'promociones');
                DB::commit();
                return redirect()->route('promociones')->with('success', 'Promocion guardada exitosamente!');
            } else {
                throw new Exception('Datos vacios!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('promociones_create')->with('error', 'Datos incorrectos!');
        }
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
        $contador=$this->contador("promocionedit=");
        $promocion=Promocion::find($id);
        return view('src.promocion.edit', compact('contador','promocion'));
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
        DB::beginTransaction();
        try {
            $promocion = Promocion::find($id);
            if ($promocion) {
                if((!empty($request->nombre_promocion)) && (!empty($request->porcentaje_promocion)))
                {
                   
                    $promocion->update([
                        'porcentaje' => $request->porcentaje_promocion,
                        'nombre' => $request->nombre_promocion,
                    ]);
                    Bitacora::store('editar', 'promociones');
                    DB::commit();
                    return redirect()->route('promociones')->with('success', 'Promocion actualizada exitosamente!');
                } else {
                    throw new Exception('Datos vacios!');    
                }
            } else {
                throw new Exception('Promocion no existe!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('promociones_edit')->with('error', 'Datos incorrectos!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $promocion = Promocion::find($id);
            if ($promocion) {
                
                if ($promocion->delete()) {
                    Bitacora::store('eliminar', 'promociones');
                    DB::commit();
                    return redirect()->route('promociones')->with('success', 'Promocion eliminado exitosamente!');
                } else {
                    throw new Exception('Error al guardar los datos!');
                }
            } else {
                throw new Exception('Promocion no existe!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('promociones')->with('error', 'Datos incorrectos!');
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
