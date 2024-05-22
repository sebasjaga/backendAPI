<?php

namespace App\Http\Controllers;

use App\Models\Juegos_has_categoria;
use Illuminate\Http\Request;

class Juegos_has_categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $juegos_has_categoria = Juegos_has_categoria::all();
      
            return response()->json([
                'status' => true,
                'juegos_has_categoria' => $juegos_has_categoria
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('juegos_has_categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $juegos_has_categoria = Juegos_has_categoria::create($request->all());

            if ($request->expectsJson()) {
                // Si la solicitud es una API, devolver una respuesta JSON
                return response()->json([
                    'status' => true,
                    'message' => "Juegos_has_categoria Creada!",
                    'juegos_has_categoria' => $juegos_has_categoria
                ], 200);
            } else {
                // dd($request->expectsJson());
                // Si la solicitud es de la web, devolver una vista
                return redirect()->route('juegos_has_categoria.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear juegos_has_categoria"
                // 'juegos_has_categoria' => $juegos_has_categoria
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
        $juegos_has_categoria = Juegos_has_categoria::find($id);

        return view('juegos_has_categoria.edit', compact('juegos_has_categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $juegos_has_categoria = Juegos_has_categoria::find($id);

            if (!$juegos_has_categoria) {
                return response()->json(['error' => 'La juegos_has_categoria no existe.'], 404);
            }
        
            $juegos_has_categoria->update($request->all());
        

            if ($request->expectsJson()) {

                return response()->json([
                    'status' => true,
                    'message' => "Juegos_has_categoria Creada!",
                    'juegos_has_categoria' => $juegos_has_categoria
                ], 200);
            } else {
                return redirect()->route('juegos_has_categoria.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear juegos_has_categoria"
                // 'juegos_has_categoria' => $juegos_has_categoria
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $juegos_has_categoria = Juegos_has_categoria::find($id);
       
        if (!$juegos_has_categoria) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'La juegos_has_categoria no existe.'], 404);
            }
        }

        $juegos_has_categoria->delete();
       
        if ($request->expectsJson()) {
            return response()->json(['message' => 'La juegos_has_categoria fue eliminada correctamente.']);
        } else {
           
            return redirect()->route('juegos_has_categoria.index');
        }
        
    }
}
