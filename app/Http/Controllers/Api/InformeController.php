<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InformeAlquiler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformeController extends Controller
{
    public function alquilerExcel(Request $request)
    {
        try {
            $query = InformeAlquiler::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'codFicha',
                'placa',
                'manifiesto',
                'titulo',
                'fechaInicio',
                'fechaFin',
                'titulo',
                'hraOpInicio',
                'hraOpFin',
                'horometroInicio',
                'horometroFin',
                'totalHoras',
                'standBy',
                'tarifa',
                'subTotal',
                'admon',
                'reteFuente',
                'reteica',
                'anticipo',
                'otros',
                'total',
            ])->where('nit', Auth::user()->nit);

            if ($request->filled('tpInforme')) {
                $query->where('clienteProveedor', $request->tpInforme);
            }

            if ($request->filled('placa')) {
                $query->where('idMaquinaria', $request->placa);
            }

            if ($request->filled('contrato')) {
                $query->where('idContrato', $request->contrato);
            }

            if ($request->filled('fechaInicio')) {
                $query->whereDate('fechaInicio', '>=', $request->fechaInicio);
            }

            if ($request->filled('fechaFin')) {
                $query->whereDate('fechaFin', '<=', $request->fechaFin);
            }

            $data = $query->get();

            return response()->json(
                ['message' => 'Registros encontrados', 'data' => $data],
                200
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}