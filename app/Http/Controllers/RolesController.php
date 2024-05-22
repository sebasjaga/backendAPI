<?php

namespace App\Http\Controllers;

use App\Models\roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Roles::all();
      
            return response()->json([
                'status' => true,
                'roles' => $roles
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $roles = Roles::create($request->all());

            if ($request->expectsJson()) {
                // Si la solicitud es una API, devolver una respuesta JSON
                return response()->json([
                    'status' => true,
                    'message' => "Rol Creado!",
                    'roles' => $roles
                ], 200);
            } else {
                // dd($request->expectsJson());
                // Si la solicitud es de la web, devolver una vista
                return redirect()->route('role.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear rol"
                // 'roles' => $roles
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        dd(2);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Roles::find($id);

        return view('roles.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $roles = Roles::find($id);

            if (!$roles) {
                return response()->json(['error' => 'El rol no existe.'], 404);
            }
        
            $roles->update($request->all());
        

            if ($request->expectsJson()) {

                return response()->json([
                    'status' => true,
                    'message' => "Rol Creada!",
                    'roles' => $roles
                ], 200);
            } else {
                return redirect()->route('roles.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el rol"
                // 'roles' => $roles
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $categoria = Categoria::find($id);
       
        if (!$categoria) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'La categoría no existe.'], 404);
            }
        }

        $categoria->delete();
       
        if ($request->expectsJson()) {
            return response()->json(['message' => 'La categoría fue eliminada correctamente.']);
        } else {
           
            return redirect()->route('categoria.index');
        }
        
    }
}
