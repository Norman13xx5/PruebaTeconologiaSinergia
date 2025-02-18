<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maquinaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaquinariaController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'placa' => 'required|string',
                'marca' => 'required|string',
                'referencia' => 'required|string',
                'modelo' => 'required|string',
                'color' => 'required|string',
                'capacidad' => 'required|string',
                'nroSerie' => 'required|string',
                'nroSerieChasis' => 'required|string',
                'nroMotor' => 'required|string',
                'rodaje' => 'required|string',
                'run' => 'required|string',
                'gps' => 'required|string',
                'propietario' => 'required|string',
                'documentoPropietario' => 'required|string',
                'telefonoPropietario' => 'required|string',
                'correoPropietario' => 'required|string',
                'operador' => 'required|string',
                'documentOperador' => 'required|string',
                'telefonOperador' => 'required|string',
                'correOperador' => 'required|string',
                'idTpMaquinaria' => 'required|numeric',
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

            $response = Maquinaria::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $maquinaria = Maquinaria::find($id);
            if (!$maquinaria) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $maquinaria], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $maquinaria = Maquinaria::find($id);
            if (!$maquinaria) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $maquinaria->status = !$maquinaria->status;
            $maquinaria->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $maquinaria = Maquinaria::find($id);
            if (!$maquinaria) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'placa' => 'required|string',
                'marca' => 'required|string',
                'referencia' => 'required|string',
                'modelo' => 'required|string',
                'color' => 'required|string',
                'capacidad' => 'required|string',
                'nroSerie' => 'required|string',
                'nroSerieChasis' => 'required|string',
                'nroMotor' => 'required|string',
                'rodaje' => 'required|string',
                'run' => 'required|string',
                'gps' => 'required|string',
                'propietario' => 'required|string',
                'documentoPropietario' => 'required|string',
                'telefonoPropietario' => 'required|string',
                'correoPropietario' => 'required|string',
                'operador' => 'required|string',
                'documentOperador' => 'required|string',
                'telefonOperador' => 'required|string',
                'correOperador' => 'required|string',
                'idTpMaquinaria' => 'required|numeric',
            ]);

            $request['idUsuario'] = Auth::user()->id;
            $request['nit'] = Auth::user()->nit;

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

            $maquinaria->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $maquinaria = Maquinaria::find($id);
            if (!$maquinaria) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $maquinaria->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}