<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Typesid;
use App\Models\Department;
use App\Models\Municipality;
use App\Models\Rol;
use App\Models\TipoMaquinaria;
use App\Models\Maquinaria;
use App\Models\Contrato;
use App\Models\Genre;
use App\Models\Ruta;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class SelectController extends Controller
{
    public function rolAll()
    {
        try {
            $select = Rol::select('nombreRol', 'id')->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }

            $select = $select->map(function ($role) {
                return [
                    'name' => $role->nombreRol,
                    'id' => $role->id,
                ];
            });

            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function tpMaquinariaAll()
    {
        try {
            $select = TipoMaquinaria::select('tipo', 'id')->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }

            $select = $select->map(function ($role) {
                return [
                    'name' => $role->tipo,
                    'id' => $role->id,
                ];
            });

            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function maquinariaAll()
    {
        try {
            $select = Maquinaria::select('placa', 'id')->where('nit', Auth::user()->nit)->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }

            $select = $select->map(function ($role) {
                return [
                    'name' => $role->placa,
                    'id' => $role->id,
                ];
            });

            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function contratoAll()
    {
        try {
            $select = Contrato::select('titulo', 'id')->where('nit', Auth::user()->nit)->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }

            $select = $select->map(function ($role) {
                return [
                    'name' => $role->titulo,
                    'id' => $role->id,
                ];
            });

            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function rutaAll()
    {
        try {
            $select = Ruta::select('origen', 'destino', 'id')->where('nit', Auth::user()->nit)->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }

            $select = $select->map(function ($role) {
                return [
                    'name' => $role->origen . " - " . $role->destino,
                    'id' => $role->id,
                ];
            });

            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


    public function materialAll()
    {
        try {
            $select = Material::select('nombre', 'id')->where('nit', Auth::user()->nit)->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }

            $select = $select->map(function ($role) {
                return [
                    'name' => $role->nombre,
                    'id' => $role->id,
                ];
            });

            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function categoryAll()
    {
        try {
            $select = Category::select('id', 'description')->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            
            $select = $select->map(function ($role) {
                return [
                    'name' => $role->description,
                    'id' => $role->id,
                ];
            });
            // dd($select);
            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function typeidAll()
    {
        try {
            $select = Typesid::select('id', 'nombre as description')->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            
            $select = $select->map(function ($role) {
                return [
                    'name' => $role->description,
                    'id' => $role->id,
                ];
            });
            // dd($select);
            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function genreAll()
    {
        try {
            $select = Genre::select('id', 'nombre as description')->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            
            $select = $select->map(function ($role) {
                return [
                    'name' => $role->description,
                    'id' => $role->id,
                ];
            });
            // dd($select);
            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function departmentAll()
    {
        try {
            $select = Department::select('id', 'nombre as description')->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            
            $select = $select->map(function ($role) {
                return [
                    'name' => $role->description,
                    'id' => $role->id,
                ];
            });
            // dd($select);
            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function municipalitytAll()
    {
        try {
            $select = Municipality::select('id', 'nombre as description')->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            
            $select = $select->map(function ($role) {
                return [
                    'name' => $role->description,
                    'id' => $role->id,
                ];
            });
            // dd($select);
            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function municipality($id)
    {
        try {
            $select = Municipality::select('id', 'nombre as description')->where('departamento_id', $id)->get();

            if ($select->isEmpty()) {
                return response()->json(['message' => 'Registro no encontrado'], 404);
            }
            
            $select = $select->map(function ($role) {
                return [
                    'name' => $role->description,
                    'id' => $role->id,
                ];
            });
            // dd($select);
            return response()->json(['message' => 'Registro encontrado', 'data' => $select], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
