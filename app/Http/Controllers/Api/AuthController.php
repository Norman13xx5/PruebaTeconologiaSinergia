<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'emailUser' => 'required|string',
                'pswd' => 'required|string',
            ]);

            $userLogin = User::where('emailUser', $request->emailUser)->first();

            if (!$userLogin || !Hash::check($request->pswd, $userLogin->pswd)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = $userLogin->createToken('auth_token')->plainTextToken;

            Auth::guard('web')->login($userLogin);
            session(['api_token' => $token]);

            // Obtener el usuario por su ID
            $user = User::with('rol.permisos.modulo')->find($userLogin->id);

            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Obtener los módulos habilitados para el rol del usuario
            $modules = $user->rol->permisos->filter(function ($permiso) {
                return $permiso->r == 1 || $permiso->w == 1 || $permiso->u == 1 || $permiso->d == 1;
            })->map(function ($permiso) {
                return $permiso->modulo;
            })->reject(function ($modulo) {
                return is_null($modulo->status);
            });

            // Agrupar los submódulos por su menuId
            $groupedSubmodules = $modules->whereNotNull('menuId')->groupBy('menuId');

            // Agregar submódulos a los módulos padres
            $modules->each(function ($module) use ($groupedSubmodules) {
                if ($groupedSubmodules->has($module->id)) {
                    $module->subModulos = $groupedSubmodules[$module->id];
                }
            });

            // Filtrar los módulos que son padres
            $parentModules = $modules->whereNull('menuId');
            session(['user_modules' => $parentModules]);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user && method_exists($user, 'currentAccessToken')) {
            $accessToken = $user->currentAccessToken();

            if ($accessToken && !$accessToken instanceof \Laravel\Sanctum\TransientToken) {
                $accessToken->delete();
            }
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Successfully logged out']);
    }
}