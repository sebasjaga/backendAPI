<?php

namespace App\Http\Controllers;

use App\Models\Biblioteca;
use Illuminate\Http\Request;

class BibliotecaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $biblioteca = Biblioteca::all();
      
            return response()->json([
                'status' => true,
                'biblioteca' => $biblioteca
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biblioteca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $bliblioteca = Biblioteca::create($request->all());

            if ($request->expectsJson()) {
                // Si la solicitud es una API, devolver una respuesta JSON
                return response()->json([
                    'status' => true,
                    'message' => "Biblioteca Creada!",
                    'biblioteca' => $bliblioteca
                ], 200);
            } else {
                // dd($request->expectsJson());
                // Si la solicitud es de la web, devolver una vista
                return redirect()->route('biblioteca.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear biblioteca"
                // 'biblioteca' => $biblioteca
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
        $biblioteca = Biblioteca::find($id);

        return view('biblioteca.edit', compact('biblioteca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $biblioteca = Biblioteca::find($id);

            if (!$biblioteca) {
                return response()->json(['error' => 'La biblioteca no existe.'], 404);
            }
        
            $biblioteca->update($request->all());
        

            if ($request->expectsJson()) {

                return response()->json([
                    'status' => true,
                    'message' => "Biblioteca Creada!",
                    'biblioteca' => $biblioteca
                ], 200);
            } else {
                return redirect()->route('bliblioteca.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear bliblioteca"
                // 'bliblioteca' => $bliblioteca
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $biblioteca = Biblioteca::find($id);
       
        if (!$biblioteca) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'La biblioteca no existe.'], 404);
            }
        }

        $biblioteca->delete();
       
        if ($request->expectsJson()) {
            return response()->json(['message' => 'La biblioteca fue eliminada correctamente.']);
        } else {
           
            return redirect()->route('biblioteca.index');
        }
        
    }
}
