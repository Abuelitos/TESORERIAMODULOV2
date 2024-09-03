<?php

namespace App\Http\Controllers;

use App\Models\Transferencia;
use App\Models\Banco;
use Illuminate\Http\Request;
use App\Models\TipoPago;

class TranferenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las transferencias con sus bancos asociados
        $transferencias = Transferencia::with(['bancoOrigen', 'bancoDestino'])->get();
        $bancos = Banco::all();
        $tipoPagos = TipoPago::all();
        return view('tranferencias.index', compact('transferencias', 'bancos', 'tipoPagos'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        // $request->validate([
        //     'Lugar' => 'required|string|max:255',
        //     'FechaProcesamiento' => 'required|date',
        //     'FechaEjecucion' => 'required|date',
        //     'BancoOrigen' => 'required|integer',
        //     'CuentaBancoOrigen' => 'required|string|max:255',
        //     'MontoNumeros' => 'required|numeric',
        //     'MontosLetras' => 'required|string|max:255',
        //     'BancoDestino' => 'required|integer',
        //     'NombreReceptor' => 'required|string|max:255',
        //     'CuentaBancoReceptor' => 'required|string|max:255',
        //     'MontoNumerosDestino' => 'required|numeric',
        //     'MontosLetrasDestino' => 'required|string|max:255',
        //     'TipoTransferencia' => 'required|string|max:255',
        //     'ConceptoTransferencia' => 'required|string|max:255',
        //     'CorreoReceptor' => 'nullable|string|max:255',
        //     'TelefonoReceptor' => 'nullable|string|max:255',
        //     'DireccionReceptor' => 'nullable|string|max:255',
        //     'Pais' => 'nullable|string|max:255',
        //     'ComisionesBancarias' => 'nullable|numeric',
        //     'NombreAutoriza' => 'required|string|max:255',
        // ]);

        // Crear la transferencia
        // Transferencia::create($request->all());

        $transferencia = new Transferencia();
        $transferencia->Lugar = $request->Lugar;
        $transferencia->FechaProcesamiento = $request->FechaProcesamiento;
        $transferencia->FechaEjecucion = $request->FechaEjecucion;
        $transferencia->BancoOrigen = $request->BancoOrigen;
        $transferencia->CuentaBancoOrigen = $request->CuentaBancoOrigen;
        $transferencia->MontoNumeros = $request->MontoNumeros;
        $transferencia->MontosLetras = $request->MontosLetras;
        $transferencia->BancoDestino = $request->BancoDestino;
        $transferencia->NombreReceptor = $request->NombreReceptor;
        $transferencia->CuentaBancoReceptor = $request->CuentaBancoReceptor;
        $transferencia->MontoNumerosDestino = $request->MontoNumerosDestino;
        $transferencia->MontosLetrasDestino = $request->MontosLetrasDestino;
        $transferencia->TipoTransferencia = $request->TipoTransferencia;
        $transferencia->ConceptoTransferencia = $request->ConceptoTransferencia;
        $transferencia->CorreoReceptor = $request->CorreoReceptor;
        $transferencia->TelefonoReceptor = $request->TelefonoReceptor;
        $transferencia->DireccionReceptor = $request->DireccionReceptor;
        $transferencia->Pais = $request->Pais;
        $transferencia->ComisionesBancarias = $request->ComisionesBancarias;
        $transferencia->NombreAutoriza = $request->NombreAutoriza;
        $transferencia->save();


        return redirect()->route('tranferencias.index')->with('success', 'Transferencia creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        // // Validar los datos de entrada
        // $request->validate([
        //     'Lugar' => 'required|string|max:255',
        //     'FechaProcesamiento' => 'required|date',
        //     'FechaEjecucion' => 'required|date',
        //     'BancoOrigen' => 'required|integer',
        //     'CuentaBancoOrigen' => 'required|string|max:255',
        //     'MontoNumeros' => 'required|numeric',
        //     'MontosLetras' => 'required|string|max:255',
        //     'BancoDestino' => 'required|integer',
        //     'NombreReceptor' => 'required|string|max:255',
        //     'CuentaBancoReceptor' => 'required|string|max:255',
        //     'MontoNumerosDestino' => 'required|numeric',
        //     'MontosLetrasDestino' => 'required|string|max:255',
        //     'TipoTransferencia' => 'required|string|max:255',
        //     'ConceptoTransferencia' => 'required|string|max:255',
        //     'CorreoReceptor' => 'nullable|string|max:255',
        //     'TelefonoReceptor' => 'nullable|string|max:255',
        //     'DireccionReceptor' => 'nullable|string|max:255',
        //     'Pais' => 'nullable|string|max:255',
        //     'ComisionesBancarias' => 'nullable|numeric',
        //     'NombreAutoriza' => 'required|string|max:255',
        // ]);

        // // Encontrar la transferencia
        // $transferencia = Transferencia::findOrFail($id);

        // // Actualizar la transferencia
        // $transferencia->update($request->all());

        $transferencia = Transferencia::findOrFail($id);
        $transferencia->Lugar = $request->Lugar;
        $transferencia->FechaProcesamiento = $request->FechaProcesamiento;
        $transferencia->FechaEjecucion = $request->FechaEjecucion;
        $transferencia->BancoOrigen = $request->BancoOrigen;
        $transferencia->CuentaBancoOrigen = $request->CuentaBancoOrigen;
        $transferencia->MontoNumeros = $request->MontoNumeros;
        $transferencia->MontosLetras = $request->MontosLetras;
        $transferencia->BancoDestino = $request->BancoDestino;
        $transferencia->NombreReceptor = $request->NombreReceptor;
        $transferencia->CuentaBancoReceptor = $request->CuentaBancoReceptor;
        $transferencia->MontoNumerosDestino = $request->MontoNumerosDestino;
        $transferencia->MontosLetrasDestino = $request->MontosLetrasDestino;
        $transferencia->TipoTransferencia = $request->TipoTransferencia;
        $transferencia->ConceptoTransferencia = $request->ConceptoTransferencia;
        $transferencia->CorreoReceptor = $request->CorreoReceptor;
        $transferencia->TelefonoReceptor = $request->TelefonoReceptor;
        $transferencia->DireccionReceptor = $request->DireccionReceptor;
        $transferencia->Pais = $request->Pais;
        $transferencia->ComisionesBancarias = $request->ComisionesBancarias;
        $transferencia->NombreAutoriza = $request->NombreAutoriza;
        $transferencia->save();

        return redirect()->route('tranferencias.index')->with('success', 'Transferencia actualizada correctamente.');
    }
}
