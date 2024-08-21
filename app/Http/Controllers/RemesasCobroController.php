<?php

namespace App\Http\Controllers;

use App\Models\RemesasCobro;
use App\Models\RemesaCobroDetalle;
use Illuminate\Http\Request;

class RemesasCobroController extends Controller
{
    public function index()
    {
        // Obtener todas las remesas con sus detalles
        $remesas = RemesasCobro::with('detalle')->get();
        return view('remesasCobros.index', compact('remesas'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'bancoColector' => 'required|string|max:100',
            'cuentaCliente' => 'required|string|max:100',
            'FechaProcesamiento' => 'required|date',
            'FechaCobro' => 'required|date',
            'TipoCuentaColectora' => 'required|string|max:255',
            'TipoCobro' => 'required|string|max:255',
            'CorreoCliente' => 'required|string|max:255',
            'ConceptoCobro' => 'required|string|max:255',
            'MontoCobrar' => 'required|numeric',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        // Crear el detalle de la remesa de cobro
        $detalle = RemesaCobroDetalle::create($request->only([
            'FechaProcesamiento',
            'FechaCobro',
            'TipoCuentaColectora',
            'TipoCobro',
            'CorreoCliente',
            'ConceptoCobro',
            'MontoCobrar',
            'NombreAutoriza'
        ]));

        // Crear la remesa de cobro y asociarla al detalle
        RemesasCobro::create([
            'bancoColector' => $request->input('bancoColector'),
            'cuentaCliente' => $request->input('cuentaCliente'),
            'idremesascobrodetalle' => $detalle->id,
        ]);

        return redirect()->route('remesasCobros.index')->with('success', 'Remesa de Cobro creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'bancoColector' => 'required|string|max:100',
            'cuentaCliente' => 'required|string|max:100',
            'FechaProcesamiento' => 'required|date',
            'FechaCobro' => 'required|date',
            'TipoCuentaColectora' => 'required|string|max:255',
            'TipoCobro' => 'required|string|max:255',
            'CorreoCliente' => 'required|string|max:255',
            'ConceptoCobro' => 'required|string|max:255',
            'MontoCobrar' => 'required|numeric',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        // Encontrar la remesa y su detalle
        $remesa = RemesasCobro::findOrFail($id);
        $detalle = $remesa->detalle;

        // Actualizar los detalles
        $detalle->update($request->only([
            'FechaProcesamiento',
            'FechaCobro',
            'TipoCuentaColectora',
            'TipoCobro',
            'CorreoCliente',
            'ConceptoCobro',
            'MontoCobrar',
            'NombreAutoriza'
        ]));

        // Actualizar la remesa
        $remesa->update([
            'bancoColector' => $request->input('bancoColector'),
            'cuentaCliente' => $request->input('cuentaCliente'),
        ]);

        return redirect()->route('remesasCobros.index')->with('success', 'Remesa de Cobro actualizada correctamente.');
    }
}
