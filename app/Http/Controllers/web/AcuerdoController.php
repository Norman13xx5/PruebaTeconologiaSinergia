<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acuerdo;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AcuerdoController extends Controller
{
    public function alquilerCliente(Request $request)
    {
        if ($request->ajax()) {

            $data = Acuerdo::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'standBy',
                'horaTarifa',
                'status',
            ])
                ->with(['maquinaria.tipoMaquinaria', 'contrato'])
                ->whereNull('deleted_at')
                ->where('modulo', "alquiler")
                ->where('clienteProveedor', "cliente")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('tipoMaquinaria', function ($row) {
                    return $row->maquinaria->tipoMaquinaria->tipo;
                })
                ->addColumn('maquinaria', function ($row) {
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
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/acuerdos/clientes/alquiler');
    }


    public function alquilerProveedor(Request $request)
    {
        if ($request->ajax()) {

            $data = Acuerdo::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'standBy',
                'horaTarifa',
                'status',
            ])
                ->with(['maquinaria.tipoMaquinaria', 'contrato'])
                ->whereNull('deleted_at')
                ->where('modulo', "alquiler")
                ->where('clienteProveedor', "proveedor")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('tipoMaquinaria', function ($row) {
                    return $row->maquinaria->tipoMaquinaria->tipo;
                })
                ->addColumn('maquinaria', function ($row) {
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
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/acuerdos/proveedores/alquiler');
    }


    public function fleteCliente(Request $request)
    {
        if ($request->ajax()) {

            $data = Acuerdo::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'idRuta',
                'flete',
                'status',
            ])
                ->with(['maquinaria.tipoMaquinaria', 'contrato', 'ruta'])
                ->whereNull('deleted_at')
                ->where('modulo', "fletes")
                ->where('clienteProveedor', "cliente")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('tipoMaquinaria', function ($row) {
                    return $row->maquinaria->tipoMaquinaria->tipo;
                })
                ->addColumn('maquinaria', function ($row) {
                    return $row->maquinaria->placa;
                })
                ->addColumn('titulo', function ($row) {
                    return $row->contrato->titulo;
                })
                ->addColumn('ruta', function ($row) {
                    return $row->ruta ? $row->ruta->origen . " - " . $row->ruta->destino : 'Sin Ruta';
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/acuerdos/clientes/fletes');
    }


    public function fleteProveedor(Request $request)
    {
        if ($request->ajax()) {

            $data = Acuerdo::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'idRuta',
                'flete',
                'status',
            ])
                ->with(['maquinaria.tipoMaquinaria', 'contrato', 'ruta'])
                ->whereNull('deleted_at')
                ->where('modulo', "fletes")
                ->where('clienteProveedor', "proveedor")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('tipoMaquinaria', function ($row) {
                    return $row->maquinaria->tipoMaquinaria->tipo;
                })
                ->addColumn('maquinaria', function ($row) {
                    return $row->maquinaria->placa;
                })
                ->addColumn('titulo', function ($row) {
                    return $row->contrato->titulo;
                })
                ->addColumn('ruta', function ($row) {
                    return $row->ruta ? $row->ruta->origen . " - " . $row->ruta->destino : 'Sin Ruta';
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/acuerdos/proveedores/fletes');
    }


    public function movimientoCliente(Request $request)
    {
        if ($request->ajax()) {

            $data = Acuerdo::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'idRuta',
                'kilometraje',
                'tarifa',
                'status',
            ])
                ->with(['maquinaria.tipoMaquinaria', 'contrato', 'ruta'])
                ->whereNull('deleted_at')
                ->where('modulo', "movimientos")
                ->where('clienteProveedor', "cliente")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('tipoMaquinaria', function ($row) {
                    return $row->maquinaria->tipoMaquinaria->tipo;
                })
                ->addColumn('maquinaria', function ($row) {
                    return $row->maquinaria->placa;
                })
                ->addColumn('titulo', function ($row) {
                    return $row->contrato->titulo;
                })
                ->addColumn('ruta', function ($row) {
                    return $row->ruta ? $row->ruta->origen . " - " . $row->ruta->destino : 'Sin Ruta';
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/acuerdos/clientes/movimientos');
    }


    public function movimientoProveedor(Request $request)
    {
        if ($request->ajax()) {

            $data = Acuerdo::select([
                'id',
                'idMaquinaria',
                'idContrato',
                'idRuta',
                'kilometraje',
                'tarifa',
                'status',
            ])
                ->with(['maquinaria.tipoMaquinaria', 'contrato', 'ruta'])
                ->whereNull('deleted_at')
                ->where('modulo', "movimientos")
                ->where('clienteProveedor', "proveedor")
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('tipoMaquinaria', function ($row) {
                    return $row->maquinaria->tipoMaquinaria->tipo;
                })
                ->addColumn('maquinaria', function ($row) {
                    return $row->maquinaria->placa;
                })
                ->addColumn('titulo', function ($row) {
                    return $row->contrato->titulo;
                })
                ->addColumn('ruta', function ($row) {
                    return $row->ruta ? $row->ruta->origen . " - " . $row->ruta->destino : 'Sin Ruta';
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/acuerdos/proveedores/movimientos');
    }
}
