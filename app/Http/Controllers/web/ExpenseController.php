<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ExpenseController extends Controller
{
    public function index($id)
    {
        $data = Expense::select('expenses.id', 'expenses.categoryId', 'categories.description as category', 'expenses.description as expense', 'expenses.amount', 'expenses.status')
            ->join('categories', 'expenses.categoryId', '=', 'categories.id')
            ->where('expenses.categoryId', $id)
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                return $row->status == 1 ? 'Activo' : 'Inactivo';
            })
            ->addColumn('action', function ($row) {
                $statusColor = $row->status == 1 ? 'info' : 'secondary';
                $btnEdit = "<button type='button' class='btn btn-success text-white' data-toggle='tooltip' data-placement='top' title='Editar Registro' onclick='editarRegistroDetalle(" . $row['id'] . ");'><i class='fal fa-edit'></i></button>";
                $btnStatus = "<button type='button' class='btn btn-" . $statusColor . " text-white' data-toggle='tooltip' data-placement='top' title='Estado del registro' onclick='statusRegistroDetalle(" . $row['id'] . ");'><i class='fal fa-eye'></i></button>";
                $btnDelete = "<button type='button' class='btn btn-danger text-white' data-toggle='tooltip' data-placement='top' title='Eliminar Registro' onclick='eliminarRegistroDetalle(" . $row['id'] . ");'><i class='fal fa-trash'></i></button>";
                // Concatenar los botones en un solo div
                return "<div class='btn-group'>" . $btnEdit . $btnStatus . $btnDelete . "</div>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
