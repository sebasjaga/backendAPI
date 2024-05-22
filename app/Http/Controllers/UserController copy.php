<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();
      
            return response()->json([
                'status' => true,
                'users' => $users
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $users = User::create($request->all());

            if ($request->expectsJson()) {
                // Si la solicitud es una API, devolver una respuesta JSON
                return response()->json([
                    'status' => true,
                    'message' => "usuario Creado!",
                    'users' => $users
                ], 200);
            } else {
                // dd($request->expectsJson());
                // Si la solicitud es de la web, devolver una vista
                return redirect()->route('users.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear usuario"
                // 'users' => $users
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
        $users = User::find($id);

        return view('users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $users = User::find($id);

            if (!$users) {
                return response()->json(['error' => 'El usuario no existe.'], 404);
            }
        
            $users->update($request->all());
        

            if ($request->expectsJson()) {

                return response()->json([
                    'status' => true,
                    'message' => "Usuario Creado!",
                    'users' => $users
                ], 200);
            } else {
                return redirect()->route('users.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear usuario"
                // 'users' => $users
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $users = User::find($id);
       
        if (!$users) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'El usuario no existe.'], 404);
            }
        }

        $users->delete();
       
        if ($request->expectsJson()) {
            return response()->json(['message' => 'El usuario fue eliminado correctamente.']);
        } else {
           
            return redirect()->route('users.index');
        }
        
    }
}
