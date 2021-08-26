<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use Exception;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("planindex=");
        $plan= Plan::listado();
        Bitacora::store('listar', 'opciones');
        return view('src.plan.index', compact('contador', 'plan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contador=$this->contador("plancreate=");
        return view('src.plan.create', compact('contador'));
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
            if(!empty($request->nombre_plan))
            {
                $mytime = Carbon::now('America/La_paz');
                $fecha = $mytime->toDateString();
                
                Plan::create([
                    'nombre' => $request->nombre_plan,
                    'fecha' => $fecha,
                ]);
                Bitacora::store('registrar', 'opciones');
                DB::commit();
                return redirect()->route('planes')->with('success', 'Opcion guardado exitosamente!');
            } else {
                throw new Exception('Datos vacios!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('planes_create')->with('error', 'Datos incorrectos!');
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
        $contador=$this->contador("planedit=");
        $plan=Plan::find($id);
        return view('src.plan.edit', compact('contador', 'plan'));
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
            $plan = Plan::find($id);
            if ($plan) {
                if(!empty($request->nombre_plan))
                {
                    $plan->update([
                        'nombre' => $request->nombre_plan
                    ]);
                    Bitacora::store('editar', 'opciones');
                    DB::commit();
                    return redirect()->route('planes')->with('success', 'Opcion actualizado exitosamente!');
                } else {
                    throw new Exception('Datos vacios!');    
                }
            } else {
                throw new Exception('Opcion no existe!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('planes_create')->with('error', 'Datos incorrectos!');
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
            $plan = Plan::find($id);
            if ($plan) {
                
                if ($plan->delete()) {
                    Bitacora::store('eliminar', 'opciones');
                    DB::commit();
                    return redirect()->route('planes')->with('success', 'Opcion eliminado exitosamente!');
                } else {
                    throw new Exception('Error al guardar los datos!');
                }
            } else {
                throw new Exception('Opcion no existe!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('planes')->with('error', 'Datos incorrectos!');
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
