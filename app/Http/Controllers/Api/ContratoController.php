<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratoController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'fechaInicio' => 'required|string',
                'fechaFin' => 'required|string',
            ]);

            $request['nit'] = Auth::user()->nit;
            $request['idUsuario'] = Auth::user()->id;

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

            $response = Contrato::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $contrato = Contrato::find($id);
            if (!$contrato) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $contrato], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $contrato = Contrato::find($id);
            if (!$contrato) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $contrato->status = !$contrato->status;
            $contrato->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $contrato = Contrato::find($id);
            if (!$contrato) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'fechaInicio' => 'required|string',
                'fechaFin' => 'required|string',
            ]);

            $request['nit'] = Auth::user()->nit;
            $request['idUsuario'] = Auth::user()->id;

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

            $contrato->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $contrato = Contrato::find($id);
            if (!$contrato) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $contrato->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
