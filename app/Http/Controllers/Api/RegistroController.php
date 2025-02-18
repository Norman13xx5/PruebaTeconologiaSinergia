<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'idMaquinaria' => 'required|numeric',
                'idContrato' => 'required|numeric',
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            $response = Registro::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $registro = Registro::find($id);
            if (!$registro) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $registro], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $registro = Registro::find($id);
            if (!$registro) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $registro->status = !$registro->status;
            $registro->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $registro = Registro::find($id);
            if (!$registro) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'idMaquinaria' => 'required|numeric',
                'idContrato' => 'required|numeric',
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            $registro->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $registro = Registro::find($id);
            if (!$registro) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $registro->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
