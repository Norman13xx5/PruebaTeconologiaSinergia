<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 4;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para crear'], 403);
            }

            $request->validate([
                'identificacion' => 'required|numeric',
                'nombres' => 'required|string',
                'aPaterno' => 'required|string',
                'aMaterno' => 'required|string',
                'emailUser' => 'required|string',
                'pswd' => 'required|string',
            ]);

            $request['nit'] = Auth::user()->nit;

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

            $request['pswd'] = Hash::make($request['pswd']);

            $response = User::create($request->all());
            $response->save();
            return response()->json(['message' => 'Registro creado correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            return response()->json(['message' => 'Registro encontrado', 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 4;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para editar'], 403);
            }

            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $user->status = !$user->status;
            $user->save();
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 4;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para actualizar'], 403);
            }
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $request->validate([
                'identificacion' => 'required|numeric',
                'nombres' => 'required|string',
                'aPaterno' => 'required|string',
                'aMaterno' => 'required|string',
                'emailUser' => 'required|string',
                'pswd' => 'required|string',
            ]);

            $request['nit'] = Auth::user()->nit;

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');

                if ($file->isValid()) {
                    $request['contentType'] = $file->getMimeType();
                    $fileContents = file_get_contents($file->getRealPath());
                    $request['base64'] = base64_encode($fileContents);
                }
            }

            $request['pswd'] = Hash::make($request['pswd']);

            $user->update($request->all());
            return response()->json(['message' => 'Registro actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            // Obtener permisos del rol
            $moduloId = 4;
            $permissions = Permission::select('w')
                ->where('rolId', Auth::user()->rolId)
                ->where('moduloId', $moduloId)
                ->first();
            // Verificar si el permiso de edición está permitido
            if (!$permissions || $permissions->w == 0) {
                return response()->json(['message' => 'No tiene permisos para eliminar'], 403);
            }

            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            $user->delete();
            return response()->json(['message' => 'Registro eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
