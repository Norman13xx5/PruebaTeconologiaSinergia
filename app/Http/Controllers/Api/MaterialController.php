<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string'
            ]);

            $request['nit'] = Auth::user()->nit;

            $response = Material::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $material = Material::find($id);
            if (!$material) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $material], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $material = Material::find($id);
            if (!$material) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $material->status = !$material->status;
            $material->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $material = Material::find($id);
            if (!$material) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'nombre' => 'required|string'
            ]);

            $request['nit'] = Auth::user()->nit;

            $material->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $material = Material::find($id);
            if (!$material) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $material->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}