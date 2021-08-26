<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Huesped;
use App\HabitacionHuesped;
use App\Imagen;
use App\Habitacion;
use Carbon\Carbon;
use App\Bitacora;
use Exception;
use App\User;

class HuespedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("huespedindex=");
        $huesped= Huesped::listado();
        Bitacora::store('listar', 'huespedes');
        return view('src.huesped.index', compact('contador', 'huesped'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contador=$this->contador("huespedcreate=");
        // $habitaciones = Habitacion::leftJoin('habitacion_huesped as hh', 'habitaciones.id', 'hh.habitacion_id')
        $activesHabitaciones = HabitacionHuesped::where('estado', 'A')->select('habitacion_id')->get();
        $habitaciones = Habitacion::whereNotin('id', $activesHabitaciones)
                                    ->get();
        return view('src.huesped.create', compact('contador', 'habitaciones'));
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

            // dd($request->all());
            if((!empty($request->nombre_huesped)) && (!empty($request->apellido_huesped)) && (!empty($request->telefono_huesped))
                && (!empty($request->nombre_usuario)) && (!empty($request->email_usuario)) && (!empty($request->password_usuario)))
            {
                $mytime = Carbon::now('America/La_paz');
                $fecha = $mytime->toDateString();
                $imagenes = empty($request->file('imagenes'))?null:Imagen::getBase64($request->file('imagenes')[0]);
                $ci = empty($request->ci_huesped)?null:$request->input('ci_huesped');
                
                $usuario = User::create([
                    'email' => $request->email_usuario,
                    'password' => Hash::make($request->password_usuario),
                    'nombre' => $request->nombre_usuario,
                    'fecha' => $fecha,
                    'foto' => $imagenes
                ]);
                
                $usuario->assignRole(3);
                
                $huesped = new Huesped();
                $huesped->apellido = $request->apellido_huesped;
                $huesped->telefono = $request->telefono_huesped;
                $huesped->nombre = $request->nombre_huesped;
                $huesped->fecha = $fecha;
                $huesped->ci = $ci;
                $huesped->user_id = $usuario->id;
                $huesped->save();
                
                Bitacora::store('registrar', 'huespedes');

                $habitacionHuesped = HabitacionHuesped::create([
                    'huesped_id' => $huesped->id,
                    'habitacion_id' => $request->habitacionid,
                    'fecha_hora_ingreso' => Carbon::now()->toDateTimeString(),
                    'nota' => $request->nota,
                    'estado' => 'A',
                ]);

                Habitacion::where('id', $request->habitacionid)->update([
                    'estado' => 'Ocupado'
                ]);

                DB::commit();
                return redirect()->route('huespedes')->with('success', 'Huesped guardado exitosamente!');
            } else {
                throw new Exception('Datos vacios!');    
            }
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('huespedes_create')->with('error', $e->getMessage());
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
        $contador=$this->contador("huespedshow=");
        $huesped=Huesped::find($id);
        $usuario=User::find($huesped->user_id);
        return view('src.huesped.show', compact('contador', 'huesped','usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contador=$this->contador("huespededit=");
        $huesped=Huesped::find($id);
        $usuario=User::find($huesped->user_id);
        $habitacionHuesped = HabitacionHuesped::where([
                                                        'huesped_id' => $id,
                                                        'estado' => 'A'
                                                    ])
                                                ->first();
        if ($habitacionHuesped) {
            $activesHabitaciones = HabitacionHuesped::where('estado', 'A')
                                    ->where('id', '<>', $habitacionHuesped->id)
                                    ->select('habitacion_id')->get();
            $habitaciones = Habitacion::whereNotin('id', $activesHabitaciones)
            ->get();
        } else {
            $activesHabitaciones = HabitacionHuesped::where('estado', 'A')
                        ->select('habitacion_id')->get();
            $habitaciones = Habitacion::whereNotin('id', $activesHabitaciones)
            ->get();
        }
        

        return view('src.huesped.edit', compact('contador', 'huesped', 'usuario', 'habitaciones', 'habitacionHuesped'));
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
        // dd($request->all()  );
        DB::beginTransaction();
        try {

            $huesped=Huesped::find($id);
            if($huesped)
            {    if((!empty($request->nombre_huesped)) && (!empty($request->apellido_huesped)) && (!empty($request->telefono_huesped)))
                {
                    // $usuario=User::find($huesped->id);
                    // $imagenes = $request->file('imagenes');
                    // if(empty($imagenes)){
                    //     $imagenes= $usuario->foto;
                    // } else {
                    //     $imagenes = Imagen::getBase64($request->file('imagenes')[0]);
                    // }
                    // $ci = empty($request->ci_huesped)?null:$request->input('ci_huesped');
                    
                    // $usuario->update([
                    //     'email' => $request->email_usuario,
                    //     'password' => Hash::make($request->password_usuario),
                    //     'nombre' => $request->nombre_usuario,
                    //     'foto' => $imagenes
                    // ]);
                    
                    $huesped->apellido = $request->apellido_huesped;
                    $huesped->telefono = $request->telefono_huesped;
                    $huesped->nombre = $request->nombre_huesped;
                    $huesped->ci = empty($request->ci_huesped)?null:$request->input('ci_huesped');
                    $huesped->update();

                    if ($request->filled('desocupar')) {
                        HabitacionHuesped::where([
                            'huesped_id' => $id,
                            'estado' => 'A'
                        ])->update([
                            'estado' => 'D',
                            'fecha_hora_salida' => Carbon::now()->toDateTimeString(),
                        ]);

                        Habitacion::where('id', $request->habitacionid)->update([
                            'estado' => 'Disponible'
                        ]);
                    } else {
                        $habitacionHuesped = HabitacionHuesped::where([
                                'huesped_id' => $id,
                                'estado' => 'A'
                            ])
                        ->first();
                        
                        if ($habitacionHuesped) {
                            $habitacionHuesped->update([
                                'nota' => $request->nota,
                                'habitacion_id' => $request->habitacionid,
                            ]);
                            Habitacion::where('id', $request->habitacionid)->update([
                                'estado' => 'Ocupado'
                            ]);
                        } else {
                            $habitacionHuesped = HabitacionHuesped::create([
                                'habitacion_id' => $request->habitacionid,
                                'fecha_hora_ingreso' => Carbon::now()->toDateTimeString(),
                                'estado' => 'A',
                                'huesped_id' => $id,
                                'nota' => $request->nota,
                            ]);
                        }
                    }
                    
                    
                    Bitacora::store('actualizar', 'huespedes');
                    DB::commit();
                    return redirect()->route('huespedes')->with('success', 'Huesped actualizado exitosamente!');
                } else {
                    throw new Exception('Datos vacios!');
                }
            } else {
                throw new Exception('No Existe Huesped!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            dd([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
            ]);
            $contador=$this->contador("huespededit=");
            $huesped=Huesped::find($id);
            $usuario=User::find($huesped->user_id);
            $habitacionHuesped = HabitacionHuesped::where([
                                                            'huesped_id' => $id,
                                                            'estado' => 'A'
                                                        ])
                                                    ->first();
            $activesHabitaciones = HabitacionHuesped::where('estado', 'A')
                                                    ->where('id', '<>', $habitacionHuesped->id)
                                                    ->select('habitacion_id')->get();
            $habitaciones = Habitacion::whereNotin('id', $activesHabitaciones)
                                        ->get();

            return redirect()
                    ->route('huespedes_edit', 
                        compact('contador', 'huesped', 'usuario', 'habitaciones', 'habitacionHuesped')
                    )
                    ->with('error', 'Datos incorrectos!');
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
            $huesped = Huesped::find($id);
            if ($huesped) {
                $user = User::find($huesped->user_id);
                $habitacionHuespeds = HabitacionHuesped::where('huesped_id', $huesped->id)->get();
                foreach ($habitacionHuespeds as $row) {
                    $habitaciones = Habitacion::where('id', $row->habitacion_id)->get();
                    foreach ($habitaciones as $habitacion) {
                        $habitacion->estado = 'Disponible';
                        $habitacion->update();
                    }   
                    $row->estado = 'D';
                    $row->update();
                }
                if ($huesped->delete() && $user->delete()) {
                    Bitacora::store('eliminar', 'huespedes');
                    DB::commit();
                    return redirect()->route('huespedes')->with('success', 'Huesped eliminado exitosamente!');
                } else {
                    throw new Exception('Error al guardar los datos!');
                }
            } else {
                throw new Exception('Huesped no existe!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('huespedes')->with('error', 'Datos incorrectos!');
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
