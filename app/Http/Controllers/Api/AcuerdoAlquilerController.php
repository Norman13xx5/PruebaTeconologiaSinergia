<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Acuerdo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcuerdoAlquilerController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'idMaquinaria' => 'required|numeric',
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            $response = Acuerdo::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $acuerdo = Acuerdo::find($id);
            if (!$acuerdo) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $acuerdo], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $acuerdo = Acuerdo::find($id);
            if (!$acuerdo) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $acuerdo->status = !$acuerdo->status;
            $acuerdo->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $acuerdo = Acuerdo::find($id);
            if (!$acuerdo) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'idMaquinaria' => 'required|numeric',
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            $acuerdo->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $acuerdo = Acuerdo::find($id);
            if (!$acuerdo) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $acuerdo->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
