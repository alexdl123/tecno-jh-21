<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use App\Habitacion;
use Carbon\Carbon;
use App\Categoria;
use Exception;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("habitacionindex=");
        $habitacion= Habitacion::listado();
        Bitacora::store('listar', 'habitaciones');
        return view('src.habitacion.index', compact('contador', 'habitacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contador=$this->contador("habitacioncreate=");
        $categoria= Categoria::listado();
        return view('src.habitacion.create', compact('contador','categoria'));
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
            if((!empty($request->descripcion_habitacion)) && (!empty($request->nrohabitacion_habitacion))
               && (!empty($request->categoria)))
            {
                $mytime = Carbon::now('America/La_paz');
                $fecha = $mytime->toDateString();
               // dd($request->nrohabitacion_habitacion);

                Habitacion::create([
                    'descripcion' => $request->descripcion_habitacion,
                    'nrohabitacion' => $request->nrohabitacion_habitacion,
                    'categoria_id' => $request->categoria,
                    'fecha' => $fecha
                ]);

                Bitacora::store('registrar', 'habitaciones');
                DB::commit();
                return redirect()->route('habitaciones')->with('success', 'Habitacion guardada exitosamente!');
            } else {
                throw new Exception('Datos vacios!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->route('habitaciones_create')->with('error', 'Datos incorrectos!');
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
        $contador=$this->contador("habitacionshow=");
        $habitacion=Habitacion::find($id);
        $categoria= Categoria::find($habitacion->categoria_id);
        return view('src.habitacion.show', compact('contador','categoria','habitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contador=$this->contador("habitacionedit=");
        $habitacion=Habitacion::find($id);
        $categoria= Categoria::listado();
        return view('src.habitacion.edit', compact('contador','categoria','habitacion'));
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
            $habitacion=Habitacion::find($id);
            if($habitacion)
            {    if((!empty($request->descripcion_habitacion)) && (!empty($request->nrohabitacion_habitacion))
                && (!empty($request->categoria)) & (!empty($request->estado)))
                {
                    
                    
                    $habitacion->update([
                        'descripcion' => $request->descripcion_habitacion,
                        'nrohabitacion' => $request->nrohabitacion_habitacion,
                        'categoria' => $request->categoria,
                        'estado' => $request->estado,                        
                    ]);
                    Bitacora::store('actualizar', 'habitaciones');
                    DB::commit();
                    return redirect()->route('habitaciones')->with('success', 'Habitacion actualizar exitosamente!');
                } else {
                    throw new Exception('Datos vacios!');    
                }
            } else {
                throw new Exception('Habitacion no existe!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('habitaciones_edit')->with('error', 'Datos incorrectos!');
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
            $habitacion = Habitacion::find($id);
            if ($habitacion) {
                
                if ($habitacion->delete()) {
                    Bitacora::store('eliminar', 'habitaciones');
                    DB::commit();
                    return redirect()->route('habitaciones')->with('success', 'Habitacion eliminado exitosamente!');
                } else {
                    throw new Exception('Error al guardar los datos!');
                }
            } else {
                throw new Exception('Habitacion no existe!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('habitaciones')->with('error', 'Datos incorrectos!');
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
