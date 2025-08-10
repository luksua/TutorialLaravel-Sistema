<?php

namespace App\Http\Controllers;

use App\Models\empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listado['empleados'] = empleado::paginate(1);
        return view('empleados.index', $listado);   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Acceder a create.blade.php de la vista para crear los empleados
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validacion de campos
        $validacion = [
            'Nombres'=>'required|string|max:90',
            'PrimerApel'=>'required|string|max:90',
            'Correo'=>'required|string|max:90',
            'Foto'=>'required'
        ];

        $msj = [
            'Nombres.required'=>'Los nombres son requeridos',
            'PrimerApel.required'=>'Su primer apellido es requerido',
            'Correo.required'=>'El correo es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $validacion, $msj);

        //datos del create empleado
        $datosEmpleado = request()->except('_token');
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }
        empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado);
        return redirect('empleados')->with('mensaje', 'Registro ingresado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado = empleado::findOrFail($id);
        return view('empleados.update', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //validacion de campos
        $validacion = [
            'Nombres'=>'required|string|max:90',
            'PrimerApel'=>'required|string|max:90',
            'Correo'=>'required|string|max:90',
            'Foto'=>'required'
        ];

        $msj = [
            'Nombres.required'=>'Los nombres son requeridos',
            'PrimerApel.required'=>'Su primer apellido es requerido',
            'Correo.required'=>'El correo es requerido'
        ];

        $datos = request()->except(['_token','_method']);

        //verifica q el usuario haya subido una nueva foto, si sí la carga
        if($request->hasFile('Foto')){
            $validacion = ['Foto'=>'required|max:10000|mimes:jpg,png,jpeg'];
            $msj = ['Foto.required'=>'La foto es requerida'];
            $datos['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        $this->validate($request, $validacion, $msj);

        //sino, sigue con la que estaba
        empleado::where('id','=',$id)->update($datos);

        return redirect('empleados')->with('mensaje', 'Registro editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $empleado = empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){
            empleado::destroy($id);
        }
        return redirect('empleados')->with('mensaje', 'Registro eliminado con exito');
    }
}
