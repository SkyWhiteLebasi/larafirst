<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados']=Empleado::paginate(2);
        return view('empleado.index',$datos );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'nombre' =>'required|string|max:100',
            'apellido_p' =>'required|string|max:100',
            'apellido_m' =>'required|string|max:100',
            'correo' =>'required|email',
            'status' =>'required|int|max:2',
            'foto' =>'required|max:10000|mimes:jpeg,png,jpg',

        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos,$mensaje);

        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token'); //trae los datos excepto el token

        if($request->hasFile('foto')){ //ára traerme la foto
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public'); 
        }
        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado); //trae todos los datos
        return redirect('empleado')->with('mensaje', 'Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'nombre' =>'required|string|max:100',
            'apellido_p' =>'required|string|max:100',
            'apellido_m' =>'required|string|max:100',
            'correo' =>'required|email',
            'status' =>'required|int|max:2',

        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
      
        ];
        if($request->hasFile('foto')){
             $campos=['foto' =>'required|max:10000|mimes:jpeg,png,jpg'];
             $mensaje=['foto.required'=>'La foto requerida'];
        }
        $this->validate($request, $campos,$mensaje);

        //
        $datosEmpleado = request()->except('_token','_method');//quitamos el token y metodo

        if($request->hasFile('foto')){ //ára traerme la foto
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->foto);
            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public'); 
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje', 'empleado modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->foto)){
            Empleado::destroy($id);
        }

        //Empleado::destroy($id);
        return redirect('empleado')->with('mensaje', 'empleado eliminado');
    }
}
