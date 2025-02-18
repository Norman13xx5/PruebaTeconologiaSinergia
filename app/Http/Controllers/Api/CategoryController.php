<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 6;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para crear'], 403);
            }

            $request->validate([
                'description' => 'required|string',
            ]);

            $request['status'] = 1;
            $request['userId'] = Auth::user()->id;

            $response = Category::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $data = Category::where('userId', Auth::user()->id)->find($id);
            if (!$data) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 6;
            $permissions = Permission::select('u')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->u == 0) {
                return response()->json(['message' => 'No tiene permisos para editar'], 403);
            }

            $empresa = Category::where('userId', Auth::user()->id)->find($id);
            if (!$empresa) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $empresa->status = !$empresa->status;
            $empresa->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 6;
            $permissions = Permission::select('u')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->u == 0) {
                return response()->json(['message' => 'No tiene permisos para actualizar'], 403);
            }

            $empresa = Category::where('userId', Auth::user()->id)->first();
            if (!$empresa) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'description' => 'required|string',
            ]);

            $empresa->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($nit)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 6;
            $permissions = Permission::select('d')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->d == 0) {
                return response()->json(['message' => 'No tiene permisos para eliminar'], 403);
            }

            $empresa = Category::find($nit);
            if (!$empresa) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $empresa->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
