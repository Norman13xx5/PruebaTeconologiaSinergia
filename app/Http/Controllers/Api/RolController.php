<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'nombreRol' => 'required|string'
            ]);
            $response = Rol::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $rol = Rol::find($id);
            if (!$rol) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $rol], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $rol = Rol::find($id);
            if (!$rol) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $rol->status = !$rol->status;
            $rol->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rol = Rol::find($id);
            if (!$rol) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'nombreRol' => 'required|string'
            ]);
            $rol->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $rol = Rol::find($id);
            if (!$rol) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $rol->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
