<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruta;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RutaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ruta::select(['id', 'nombre', 'origen', 'destino', 'status'])
                ->where('deleted_at', NULL)
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
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

        return view('operaciones/rutas/rutas');
    }
}
