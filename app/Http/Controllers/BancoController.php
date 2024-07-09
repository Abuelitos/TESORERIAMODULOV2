<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banco;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banco = Banco::all();
        return view('bancos.index', compact('banco'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'Nombre' => 'required|string|max:255',
    ]);

    // Crear una nueva instancia del modelo Banco
    $banco = new Banco();
    $banco->nombre = $request->input('Nombre');
    $banco->activo = true; // Establecer el campo activo como true

    // Guardar el nuevo banco en la base de datos
    $banco->save();

    // Redirigir o devolver una respuesta adecuada
    return redirect()->route('bancos.index')->with('success', 'Banco creado correctamente');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'Nombre' => 'required|string|max:255',
        ]);
    
        // Buscar el banco por su ID
        $banco = Banco::findOrFail($id);
    
        // Actualizar los campos del banco
        $banco->nombre = $request->input('Nombre');
    
        // Guardar los cambios en la base de datos
        $banco->save();
    
        // Redirigir o devolver una respuesta adecuada
        return redirect()->route('bancos.index')->with('success', 'Banco actualizado correctamente');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
