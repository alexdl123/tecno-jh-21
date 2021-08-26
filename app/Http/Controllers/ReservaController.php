<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use App\Habitacion;
use Carbon\Carbon;
use App\Reserva;
use App\DetalleReserva;
use App\Huesped;
use App\Promocion;
use Exception;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("reservaindex=");
        $user = Auth::user()->rol_id;
        $reserva= Reserva::listado();
        //dd($user);
        if($user == 3){
            $huesped = Huesped::getHuesped(Auth::user()->id);
            $reserva = Reserva::mislistado($huesped->id);
        }
        
        Bitacora::store('listar', 'reservas');
        return view('src.reserva.index', compact('contador', 'reserva'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contador=$this->contador("reservacreate=");
        $habitacion = Habitacion::listado();
        $huesped = Huesped::listado();
        $promocion = Promocion::listado();
        return view('src.reserva.create', compact('contador','promocion','huesped','habitacion'));
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
            if((!empty($request->fechaingreso_reserva)) && (!empty($request->fechasalida_reserva))
                && (!empty($request->huesped)) /*&& (!empty($request->habitacion))*/)
            {
                $mytime = Carbon::now('America/La_paz');
                $fecha = $mytime->toDateString();
                $promocion = empty($request->promocion)?null:$request->promocion;
                $descripcion = empty($request->descripcion_reserva)?null:$request->descripcion_reserva;
                
                $reserva = Reserva::create([
                    'descripcion' => $descripcion,
                    'huesped_id' => $request->huesped,
                    'promocion_id' => $request->promocion,
                    'user_id' => Auth::user()->id,
                    'fecha' => $fecha,
                    'fecha_ingreso' => $request->fechaingreso_reserva,
                    'fecha_salida' => $request->fechasalida_reserva,
                ]);
                $habitacion = $request->habitacion;
                foreach($habitacion as $h){
                    DetalleReserva::create([
                        'fecha' => $fecha,
                        'reserva_id' => $reserva->id,
                        'habitacion_id' => $h
                    ]);
                }
                Bitacora::store('registrar', 'reservas');
                DB::commit();
                return redirect()->route('reservas')->with('success', 'Reserva guardada exitosamente!');
            } else {
                dd($request->all());
                throw new Exception('Datos vacios!', $request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->route('reservas_create')->with('error', 'Datos incorrectos!');
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
        $contador=$this->contador("reservashow=");
        $reserva=Reserva::find($id);
        $habitacion = DetalleReserva::listado($id);
        $huesped = Huesped::find($reserva->huesped_id);
        $promocion = Promocion::find($reserva->promocion_id);
        return view('src.reserva.show', compact('contador','promocion','reserva','huesped','habitacion'));
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
        DB::beginTransaction();
        try {
            $reserva = Reserva::find($id);
            if ($reserva) {
                
                if ($reserva->delete()) {
                    Bitacora::store('eliminar', 'reservas');
                    DB::commit();
                    return redirect()->route('reservas')->with('success', 'Reserva eliminado exitosamente!');
                } else {
                    throw new Exception('Error al guardar los datos!');
                }
            } else {
                throw new Exception('Reserva no existe!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('reservas')->with('error', 'Datos incorrectos!');
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
