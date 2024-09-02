<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use App\Models\TipoPersona;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        $tipos = TipoPersona::all();
        return view('clientes.index', compact('clientes', 'tipos'));
    }

    public function store(Request $request)
    {
        $dui = $request->input('dui');

        // Verificar si el dui ya existe
        $existingCliente = Cliente::where('dui', $dui)->first();
        if ($existingCliente) {
            // Si el dui ya existe, redirigir con un mensaje de error
            session()->flash('message', 'No se pudo agregar porque ese dui ya existe!');
            return redirect()->route('clientes.index');
        }

        $cliente = new Cliente();
        $cliente->dui = $dui;
        $cliente->Nombres = $request->input('Nombres');
        $cliente->Apellidos = $request->input('Apellidos');
        $cliente->Telefono = $request->input('Telefono');
        $cliente->Direccion = $request->input('Direccion');
        $cliente->Celular = $request->input('Celular');
        $cliente->tipoPersonaId = $request->input('TipoPersonaId');
        $cliente->Fecha_nacimiento = $request->input('Fecha_nacimiento');
        $cliente->save();

        session()->flash('message', 'Cliente guardado con éxito!');

        return redirect()->route('clientes.index');
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }


    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return redirect()->route('clientes.index');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json(null, 204);
    }

    public function buscarPorDui($id)
    {
        // Here, $id represents the DUI passed in the URL
        $cliente = Cliente::where('dui', $id)->first();
    
        if ($cliente) {
            return response()->json(['success' => true, 'cliente' => $cliente]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cliente no encontrado']);
        }
    }
    
    

}
