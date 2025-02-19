<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'tipo_documento_id' => 'required|numeric',
                'numero_documento' => 'required|numeric',
                'nombre1' => 'required|string',
                // 'nombre2' => 'required|string',
                'apellido1' => 'required|string',
                'apellido2' => 'required|string',
                'genero_id' => 'required|numeric',
                'departamento_id' => 'required|numeric',
                'municipio_id' => 'required|numeric',
            ]);
            // if ($request->hasFile('archivo')) {
            //     $file = $request->file('archivo');

            //     if ($file->isValid()) {
            //         $request['contentType'] = $file->getMimeType();
            //         $fileContents = file_get_contents($file->getRealPath());
            //         $request['base64'] = base64_encode($fileContents);
            //     }
            // }
            // dd($request->all());

            $response = Patient::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $empresa = Patient::find($id);
            if (!$empresa) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $empresa], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $paciente = Patient::find($id);
            if (!$paciente) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $paciente->status = !$paciente->status;
            $paciente->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            
            $paciente = Patient::where('id', $id)->first();
            if (!$paciente) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'tipo_documento_id' => 'required|numeric',
                'numero_documento' => 'required|numeric',
                'nombre1' => 'required|string',
                // 'nombre2' => 'required|string',
                'apellido1' => 'required|string',
                'apellido2' => 'required|string',
                'genero_id' => 'required|numeric',
                'departamento_id' => 'required|numeric',
                'municipio_id' => 'required|numeric',
            ]);

            // if ($request->hasFile('archivo')) {
            //     $file = $request->file('archivo');

            //     if ($file->isValid()) {
            //         $request['contentType'] = $file->getMimeType();
            //         $fileContents = file_get_contents($file->getRealPath());
            //         $request['base64'] = base64_encode($fileContents);
            //     }
            // }
            $paciente->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {  
        try {
            $paciente = Patient::find($id);
            if (!$paciente) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $paciente->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
