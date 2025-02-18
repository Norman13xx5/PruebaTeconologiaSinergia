<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maquinaria;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MaquinariaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Maquinaria::select([
                'id',
                'placa',
                'marca',
                'referencia',
                'modelo',
                'color',
                'capacidad',
                'nroSerie',
                'nroSerieChasis',
                'nroMotor',
                'rodaje',
                'run',
                'gps',
                'fechaSoat',
                'fechaTecno',
                'propietario',
                'documentoPropietario',
                'telefonoPropietario',
                'correoPropietario',
                'operador',
                'documentOperador',
                'telefonOperador',
                'correOperador',
                'idTpMaquinaria',
                'contentType',
                'base64',
                'status'
            ])
                ->with('tipoMaquinaria')
                ->whereNull('deleted_at')
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('tipo', function ($row) {
                    return $row->tipoMaquinaria->tipo;
                })
                ->addColumn('action', function ($row) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';
                    $btn = "<div class='btn-group'>";
                    $btn .= "<button type='button' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='Ver docuemntación en PDF' onclick='visualizarPDF(`" . $row['contentType'] . "`, `" . $row['base64'] . "`);'><i class='fal fa-file-pdf'></i></button>";
                    $btn .= "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                    $btn .= "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                    $btn .= "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operaciones/maquinarias/maquinarias');
    }
}