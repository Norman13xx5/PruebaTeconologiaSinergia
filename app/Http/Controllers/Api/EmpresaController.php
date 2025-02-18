<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function create(Request $request)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 3;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para crear'], 403);
            }

            $request->validate([
                'nit' => 'required|numeric',
                'digito' => 'required|numeric',
                'nombre' => 'required|string',
                'correo' => 'required|string',
            ]);

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

            $response = Empresa::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($nit)
    {
        try {
            $empresa = Empresa::find($nit);
            if (!$empresa) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $empresa], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($nit)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 3;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para editar'], 403);
            }

            $empresa = Empresa::find($nit);
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

    public function update(Request $request, $nit)
    {

        try {
            // Obtener permisos del rol
            $moduloId = 3;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para actualizar'], 403);
            }
            
            $empresa = Empresa::where('id', $nit)->first();
            if (!$empresa) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'nit' => 'required|numeric',
                'digito' => 'required|numeric',
                'nombre' => 'required|string',
                'correo' => 'required|string',
            ]);

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

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
            $moduloId = 3;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para eliminar'], 403);
            }

            $empresa = Empresa::find($nit);
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
