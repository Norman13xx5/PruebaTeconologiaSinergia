<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $moduleId = '5';
        if ($request->ajax()) {
            $permissions = Permission::select('r', 'w', 'u', 'd')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduleId)
                ->first();
            //Pendiente para que redireccione a una pagina que informe la denegación del permiso
            if (!$permissions || $permissions->r == 0) {
                return response()->json(['message' => 'No tiene permisos para leer'], 403);
            }
            $data = Salary::select([
                'id',
                'description',
                'amount',
                'status',
            ])->where('deleted_at', NULL);

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Activo' : 'Inactivo';
                })
                ->addColumn('action', function ($row) use ($permissions) {
                    $statusColor = $row->status == 1 ? 'info' : 'secondary';
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
        return view('cuentas/salarios/salarios');
    }
}
