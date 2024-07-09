<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
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
        $cliente->Nombres = $request->input('nombres');
        $cliente->Apellidos = $request->input('apellidos');
        $cliente->Telefono = $request->input('telefono');
        $cliente->Direccion = $request->input('direccion');
        $cliente->Celular = $request->input('celular');
        $cliente->Fecha_nacimiento = $request->input('fecha_nacimiento');
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
        return response()->json($cliente, 200);
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json(null, 204);
    }
}
