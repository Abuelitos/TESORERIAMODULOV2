<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Transferencia;
use App\Models\NotaAbono;
use App\Models\NotaCargo;
use App\Models\Cheque;
use App\Models\RemesasCobro;
use App\Models\RemesaPago;
use App\Exports\GenericExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;



class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reporteria.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    

    public function generarReporteApi(Request $request)
    {
        $fechaDesde = $request->query('desde');
        $fechaHasta = $request->query('hasta');
        $tipoReporte = $request->query('tipoReporte');
    
        Log::info('Parámetros recibidos:', [
            'tipoReporte' => $tipoReporte,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta
        ]);
    
        if (!$tipoReporte || !$fechaDesde || !$fechaHasta) {
            return response()->json(['error' => 'Faltan parámetros requeridos.'], 400);
        }
    
        $resultados = [];
    
        switch ($tipoReporte) {
            case 'Clientes':
                $resultados = Cliente::whereBetween('created_at', [$fechaDesde, $fechaHasta])->get();
                break;
            case 'Transferencias':
                $resultados = Transferencia::whereBetween('created_at', [$fechaDesde, $fechaHasta])->get();
                break;
            case 'NotasIngresos':
                $resultados = NotaAbono::whereBetween('created_at', [$fechaDesde, $fechaHasta])->get();
                break;
            case 'NotasEgresos':
                $resultados = NotaCargo::whereBetween('created_at', [$fechaDesde, $fechaHasta])->get();
                break;
            case 'Cheques':
                $resultados = Cheque::whereBetween('created_at', [$fechaDesde, $fechaHasta])->get();
                break;
            case 'RemesasCobros':
                $resultados = RemesasCobro::whereBetween('created_at', [$fechaDesde, $fechaHasta])->get();
                break;
            case 'RemesasPagos':
                $resultados = RemesaPago::whereBetween('created_at', [$fechaDesde, $fechaHasta])->get();
                break;
            default:
                Log::warning('Tipo de reporte no válido:', ['tipoReporte' => $tipoReporte]);
                return response()->json(['error' => 'Tipo de reporte no válido.'], 400);
        }
    
        return response()->json([
            'success' => true,
            'resultados' => $resultados,
            'tipoReporte' => $tipoReporte,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta
        ]);
    }
    

    
}
