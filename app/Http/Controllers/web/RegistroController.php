<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RegistroController extends Controller
{
    public function alquiler(Request $request)
    {
        if ($request->ajax()) {
            $data = Registro::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'manifiesto',
                'codFicha',
                'fechaInicio',
                'fechaFin',
                'hraOpInicio',
                'hraOpFin',
                'horometroInicio',
                'horometroFin',
                'observacion',
                'idUsuario',
                'status'
            ])
                ->with(['maquinaria', 'contrato'])
                ->whereNull('deleted_at')
                ->where('modulo', "alquiler")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('placa', function ($row) {
                    return $row->maquinaria->placa;
                })
                ->addColumn('titulo', function ($row) {
                    return $row->contrato->titulo;
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-primary text-white' data-toggle='tooltip' data-placement='top' title='Agregar Descontables' onclick='deducibles(" . $row['id'] . ", " . $row['codFicha'] . ");'><i class='fal fa-file-invoice-dollar'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/registros/alquiler');
    }


    public function flete(Request $request)
    {
        if ($request->ajax()) {
            $data = Registro::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'manifiesto',
                'codFicha',
                'fechaInicio',
                'fechaFin',
                'observacion',
                'status'
            ])
                ->with(['maquinaria', 'contrato.acuerdo'])
                ->whereNull('deleted_at')
                ->where('modulo', "fletes")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('placa', function ($row) {
                    return $row->maquinaria->placa;
                })
                ->addColumn('titulo', function ($row) {
                    return $row->contrato->titulo;
                })
                ->addColumn('flete', function ($row) {
                    return $row->contrato->acuerdo->flete;
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-primary text-white' data-toggle='tooltip' data-placement='top' title='Agregar Descontables' onclick='deducibles(" . $row['id'] . ", " . $row['codFicha'] . ");'><i class='fal fa-file-invoice-dollar'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/registros/fletes');
    }


    public function movimiento(Request $request)
    {
        if ($request->ajax()) {
            $data = Registro::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'manifiesto',
                'codFicha',
                'movimientos',
                'mts3',
                'fechaInicio',
                'fechaFin',
                'observacion',
                'status'
            ])
                ->with(['maquinaria', 'contrato.acuerdo.ruta'])
                ->whereNull('deleted_at')
                ->where('modulo', "movimientos")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('placa', function ($row) {
                    return $row->maquinaria->placa;
                })
                ->addColumn('titulo', function ($row) {
                    return $row->contrato->titulo;
                })
                ->addColumn('kilometraje', function ($row) {
                    return $row->contrato->acuerdo->kilometraje;
                })
                ->addColumn('tarifa', function ($row) {
                    return $row->contrato->acuerdo->tarifa;
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-primary text-white' data-toggle='tooltip' data-placement='top' title='Agregar Descontables' onclick='deducibles(" . $row['id'] . ", " . $row['codFicha'] . ");'><i class='fal fa-file-invoice-dollar'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/registros/movimientos');
    }
}
