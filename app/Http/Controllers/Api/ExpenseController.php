<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            $expenses = Expense::select('expenses.id', 'expenses.categoryId', 'categories.description as category', 'expenses.description as expense', 'expenses.amount', 'expenses.status')
                ->join('categories', 'expenses.categoryId', '=', 'categories.id')
                ->where('expenses.categoryId', $id)
                ->get();
            if (!$expenses) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $expenses], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'categoryId' => 'required|string',
                'description' => 'required|string',
                'amount' => 'required|numeric',
            ]);

            $request['userId'] = Auth::user()->id;
            $request['status'] = 1;

            $response = Expense::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
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
    public function show($id)
    {
        try {
            $expense = Expense::find($id);
            if (!$expense) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $expense], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        try {
            $expense = Expense::find($id);
            if (!$expense) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $expense->status = !$expense->status;
            $expense->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $expense = Expense::find($id);
            if (!$expense) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'description' => 'required|string',
                'amount' => 'required|numeric',
            ]);
            $expense->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nit)
    {
        try {
            $expense = Expense::find($nit);
            if (!$expense) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $expense->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
