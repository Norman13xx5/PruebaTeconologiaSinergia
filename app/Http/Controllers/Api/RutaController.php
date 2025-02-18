<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RutaController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string'
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            $response = Ruta::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $ruta = Ruta::find($id);
            if (!$ruta) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $ruta], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $ruta = Ruta::find($id);
            if (!$ruta) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $ruta->status = !$ruta->status;
            $ruta->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ruta = Ruta::find($id);
            if (!$ruta) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'nombre' => 'required|string'
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            $ruta->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $ruta = Ruta::find($id);
            if (!$ruta) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $ruta->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
