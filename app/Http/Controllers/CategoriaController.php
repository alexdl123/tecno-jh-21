<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Carbon\Carbon;
use App\Imagen;
use Illuminate\Support\Facades\DB;
use App\Bitacora;
use App\User;
use Exception;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contador=$this->contador("categoriaindex=");
        $categoria= Categoria::listado();
        Bitacora::store('listar', 'categorias');
        return view('src.categoria.index', compact('contador', 'categoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contador=$this->contador("categoriacreate=");
        return view('src.categoria.create', compact('contador'));
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
            if((!empty($request->nombre_categoria)))
            {
                $mytime = Carbon::now('America/La_paz');
                $fecha = $mytime->toDateString();
                $imagenes = empty($request->file('imagenes'))?null:Imagen::getBase64($request->file('imagenes')[0]);
                $descripcion = empty($request->descripcion_categoria)?null:$request->descripcion_categoria;
                
                Categoria::create([
                    'descripcion' => $descripcion,
                    'nombre' => $request->nombre_categoria,
                    'fecha' => $fecha,
                    'img' => $imagenes
                ]);
                Bitacora::store('registrar', 'categorias');
                DB::commit();
                return redirect()->route('categorias')->with('success', 'Categoria guardada exitosamente!');
            } else {
                throw new Exception('Datos vacios!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('categorias_create')->with('error', 'Datos incorrectos!');
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
        $contador=$this->contador("categoriashow=");
        $categoria=Categoria::find($id);
        return view('src.categoria.show', compact('contador', 'categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contador=$this->contador("categoriaedit=");
        $categoria=Categoria::find($id);
        return view('src.categoria.edit', compact('contador', 'categoria'));
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
            $categoria = Categoria::find($id);
            if ($categoria) {
                if((!empty($request->nombre_categoria)))
                {
                    $imagenes = $request->file('imagenes');
                    if(empty($imagenes)){
                        $imagenes= $categoria->img;
                    } else {

                    $imagenes = Imagen::getBase64($request->file('imagenes')[0]);
                    }
                    $descripcion = empty($request->descripcion_categoria)?null:$request->descripcion_categoria;
                
                    $categoria->update([
                        'descripcion' => $descripcion,
                        'nombre' => $request->nombre_categoria,
                        'img' => $imagenes
                    ]);
                    Bitacora::store('editar', 'categorias');
                    DB::commit();
                    return redirect()->route('categorias')->with('success', 'Categoria actualizada exitosamente!');
                } else {
                    throw new Exception('Datos vacios!');    
                }
            } else {
                throw new Exception('Categoria no existe!');    
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('categorias_edit')->with('error', 'Datos incorrectos!');
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
            $categoria = Categoria::find($id);
            if ($categoria) {
                
                if ($categoria->delete()) {
                    Bitacora::store('eliminar', 'categorias');
                    DB::commit();
                    return redirect()->route('categorias')->with('success', 'Categoria eliminado exitosamente!');
                } else {
                    throw new Exception('Error al guardar los datos!');
                }
            } else {
                throw new Exception('Categoria no existe!');
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('categorias')->with('error', 'Datos incorrectos!');
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
