<?php

namespace App\Http\Controllers;

use App\Models\RemesaPago;
use App\Models\RemesaPagoDetalle;
use Illuminate\Http\Request;

class RemesasPagoController extends Controller
{
    public function index()
    {
        // Obtener todas las remesas con sus detalles
        $remesas = RemesaPago::with('detalle')->get();
        return view('remesasPagos.index', compact('remesas'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'bancoPagador' => 'required|string|max:100',
            'cuentaCliente' => 'required|string|max:100',
            'FechaProcesamiento' => 'required|date',
            'FechaPago' => 'required|date',
            'TipoCuentaPagadora' => 'required|string|max:255',
            'TipoPago' => 'required|string|max:255',
            'CorreoBeneficiario' => 'required|string|max:255',
            'ConceptoPago' => 'required|string|max:255',
            'MontoPagar' => 'required|numeric',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        // Crear el detalle de la remesa de pago
        $detalle = RemesaPagoDetalle::create($request->only([
            'FechaProcesamiento',
            'FechaPago',
            'TipoCuentaPagadora',
            'TipoPago',
            'CorreoBeneficiario',
            'ConceptoPago',
            'MontoPagar',
            'NombreAutoriza'
        ]));

        // Crear la remesa de pago y asociarla al detalle
        RemesaPago::create([
            'bancoPagador' => $request->input('bancoPagador'),
            'cuentaCliente' => $request->input('cuentaCliente'),
            'pagoDetalle' => $detalle->id,
        ]);

        return redirect()->route('remesasPagos.index')->with('success', 'Remesa de Pago creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'bancoPagador' => 'required|string|max:100',
            'cuentaCliente' => 'required|string|max:100',
            'FechaProcesamiento' => 'required|date',
            'FechaPago' => 'required|date',
            'TipoCuentaPagadora' => 'required|string|max:255',
            'TipoPago' => 'required|string|max:255',
            'CorreoBeneficiario' => 'required|string|max:255',
            'ConceptoPago' => 'required|string|max:255',
            'MontoPagar' => 'required|numeric',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        // Encontrar la remesa y su detalle
        $remesa = RemesaPago::findOrFail($id);
        $detalle = $remesa->detalle;

        // Actualizar los detalles
        $detalle->update($request->only([
            'FechaProcesamiento',
            'FechaPago',
            'TipoCuentaPagadora',
            'TipoPago',
            'CorreoBeneficiario',
            'ConceptoPago',
            'MontoPagar',
            'NombreAutoriza'
        ]));

        // Actualizar la remesa
        $remesa->update([
            'bancoPagador' => $request->input('bancoPagador'),
            'cuentaCliente' => $request->input('cuentaCliente'),
        ]);

        return redirect()->route('remesasPagos.index')->with('success', 'Remesa de Pago actualizada correctamente.');
    }
}
