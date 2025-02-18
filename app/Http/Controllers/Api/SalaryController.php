<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        try {
            $moduloId = 5;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para crear'], 403);
            }

            $request->validate([
                'description' => 'required|string',
                'amount' => 'required|numeric',
            ]);

            $request['userId'] = Auth::user()->id;
            $request['status'] = 1;

            $response = Salary::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $salary = Salary::find($id);
            if (!$salary) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $salary], 200);
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
            // Obtener permisos del rol
            $moduloId = 5;
            $permissions = Permission::select('u')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->u == 0) {
                return response()->json(['message' => 'No tiene permisos para editar'], 403);
            }

            $salary = Salary::find($id);
            if (!$salary) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $salary->status = !$salary->status;
            $salary->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 5;
            $permissions = Permission::select('u')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->u == 0) {
                return response()->json(['message' => 'No tiene permisos para actualizar'], 403);
            }

            $salary = Salary::where('id', $id)->first();
            if (!$salary) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'description' => 'required|string',
                'amount' => 'required|numeric',
            ]);

            $salary->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $moduloId = 5;
            $permissions = Permission::select('d')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->d == 0) {
                return response()->json(['message' => 'No tiene permisos para eliminar'], 403);
            }

            $salary = Salary::find($id);
            if (!$salary) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $salary->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
