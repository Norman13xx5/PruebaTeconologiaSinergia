<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $moduloId = 4;
        if ($request->ajax()) {
            $permissions = Permission::select('w', 'u', 'd')
            ->where('rolId', Auth::user()->rolId)
            ->where('moduloId', $moduloId)
            ->first();

            $data = User::select([
                'id',
                'nit',
                'identificacion',
                'nombres',
                'aPaterno',
                'aMaterno',
                'telefono',
                'emailUser',
                'pswd',
                'nombreFiscal',
                'direccionFiscal',
                'contentType',
                'base64',
                'rolId',
                'status',
            ])
                ->with('rol')
                ->where('deleted_at', NULL)
                ->where('nit', Auth::user()->nit);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('rol', function ($row) {
                    return $row->rol->nombreRol;
                })
                ->addColumn('action', function ($row) use ($permissions) {
                    $statusColor = $row['status'] == 1 ? 'info' : 'secondary';

                    // Generar los botones usando el operador ternario
                    $btnEdit = ($permissions && $permissions->w == 1)
                        ? "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistro(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>"
                        : '';

                    $btnStatus = ($permissions && $permissions->u == 1)
                        ? "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistro(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>"
                        : '';

                    $btnDelete = ($permissions && $permissions->d == 1)
                        ? "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistro(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>"
                        : '';

                    // Concatenar los botones en un solo div
                    return "<div class='btn-group'>" . $btnEdit . $btnStatus . $btnDelete . "</div>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cuentas/usuarios/usuarios');
    }
}
