<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Bitacora;
use App\Imagen;
use Exception;
use App\User;
use App\Rol;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("usuarioindex=");
        $usuario= User::listado();
        Bitacora::store('listar', 'usuarios');
        return view('src.usuario.index', compact('contador', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contador=$this->contador("usuariocreate=");
        $rol = Rol::getRoles();
        return view('src.usuario.create', compact('contador','rol'));
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
            if((!empty($request->nombre_usuario)) && (!empty($request->email_usuario)) && (!empty($request->password_usuario)))
            {
                $mytime = Carbon::now('America/La_paz');
                $fecha = $mytime->toDateString();
                $imagenes = empty($request->file('imagenes'))?null:Imagen::getBase64($request->file('imagenes')[0]);
                
                $usuario = User::create([
                    'email' => $request->email_usuario,
                    'password' => Hash::make($request->password_usuario),
                    'nombre' => $request->nombre_usuario,
                    'fecha' => $fecha,
                    'foto' => $imagenes,
                    'rol_id' => $request->rol
                ]);
                
                $usuario->assignRole($request->rol);
                Bitacora::store('registrar', 'usuarios');
                DB::commit();
                return redirect()->route('usuarios')->with('success', 'Usuario guardado exitosamente!');
            } else {
                throw new Exception('Datos vacios!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('usuarios_create')->with('error', 'Datos incorrectos!');
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
        // dd($id);
        $contador=$this->contador("usuarioshow=");
        $usuario=User::find($id);
        return view('src.usuario.show', compact('contador','usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::getRoles();
        $contador=$this->contador("usuarioedit=");
        $usuario=User::find($id);
        return view('src.usuario.edit', compact('contador', 'rol','usuario'));
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

            $usuario=User::find($id);
            if($usuario)
            {    if((!empty($request->nombre_usuario)) && (!empty($request->email_usuario)) && (!empty($request->password_usuario)))
                {
                    
                    $imagenes = $request->file('imagenes');
                    if(empty($imagenes)){
                        $imagenes= $usuario->foto;
                    } else {

                        $imagenes = Imagen::getBase64($request->file('imagenes')[0]);
                    }
                    
                    $usuario->update([
                        'email' => $request->email_usuario,
                        'password' => Hash::make($request->password_usuario),
                        'nombre' => $request->nombre_usuario,
                        'foto' => $imagenes,
                        'rol_id' => $request->rol
                    ]);
                    $usuario->assignRole($request->rol);
                    
                    Bitacora::store('actualizar', 'usuarios');
                    DB::commit();
                    return redirect()->route('usuarios')->with('success', 'Usuario actualizado exitosamente!');
                } else {
                    throw new Exception('Datos vacios!');    
                }
            } else {
                throw new Exception('No Existe Usuario!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('usuarios_edit')->with('error', 'Datos incorrectos!');
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
            $user = User::find($id);
            if ($user) {
                if ($user->delete()) {
                    Bitacora::store('eliminar', 'usuarios');
                    DB::commit();
                    return redirect()->route('usuarios')->with('success', 'Usuario eliminado exitosamente!');
                } else {
                    throw new Exception('Error al guardar los datos!');
                }
            } else {
                throw new Exception('Usuario no existe!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('usuarios')->with('error', 'Datos incorrectos!');
        }
    }

    public function buscar(Request $request)
    {   $contador = $this->contador("resultado=");
        $dato = strtolower($request->dato);
        // dd($dato);
        $categorias = DB::select("select * from categoria where (lower(descripcion) like '%$dato%'  or lower(nombre) like '%$dato%'
                 ) and deleted_at IS NULL ");
        $usuarios = DB::select("select * from users where (lower(email) like '%$dato%' or lower(nombre) like '%$dato%' 
            ) and deleted_at IS NULL ");
        $huespedes = DB::select("select * from huesped where (nombre like '%$dato%' 
            or lower(apellido) like '%$dato%' or CAST(telefono AS text) like '%$dato%') and deleted_at IS NULL ");
        $promociones = DB::select("select * from promocion where (lower(nombre) like '%$dato%' or CAST(porcentaje AS text) like '%$dato%' 
            ) and deleted_at IS NULL ");
        $habitaciones = DB::select("select * from habitaciones where (lower(descripcion) like '%$dato%' or CAST(nrohabitacion AS text) like '%$dato%' 
            ) and deleted_at IS NULL ");      
        $reservas = DB::select("select * from reserva where lower(descripcion) like '%$dato%' 
            and deleted_at IS NULL");
        if(Auth::user()->rol_id == 3){
            $huesped = Huesped::getHuesped(Auth::user()->id);
            $reservas = DB::select("select * from reserva where lower(descripcion) like '%$dato%' and deleted_at IS NULL and huesped_id =".$huesped->id);
        }
        return view('src.buscador.index', compact('dato', 'categorias', 'usuarios', 'huespedes', 'habitaciones', 'promociones', 'reservas','contador'));
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
