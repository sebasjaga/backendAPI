<?php

namespace App\Http\Controllers;

use App\Models\Juegos;
use Illuminate\Http\Request;

class JuegosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $juegos = Juegos::all();
      
            return response()->json([
                'status' => true,
                'juegos' => $juegos
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('juegos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $juegos = Juegos::create($request->all());

            if ($request->expectsJson()) {
                // Si la solicitud es una API, devolver una respuesta JSON
                return response()->json([
                    'status' => true,
                    'message' => "Juego Creado!",
                    'juegos' => $juegos
                ], 200);
            } else {
                // dd($request->expectsJson());
                // Si la solicitud es de la web, devolver una vista
                return redirect()->route('juegos.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear el juego"
                // 'juegos' => $juegos
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
        $juegos = Juegos::find($id);

        return view('juegos.edit', compact('juegos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $juegos = Juegos::find($id);

            if (!$juegos) {
                return response()->json(['error' => 'El juego no existe.'], 404);
            }
        
            $juegos->update($request->all());
        

            if ($request->expectsJson()) {

                return response()->json([
                    'status' => true,
                    'message' => "juego Creado!",
                    'juegos' => $juegos
                ], 200);
            } else {
                return redirect()->route('juegos.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear juego"
                // 'juegos' => $juegos
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $juegos = Juegos::find($id);
       
        if (!$juegos) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'El juego no existe.'], 404);
            }
        }

        $juegos->delete();
       
        if ($request->expectsJson()) {
            return response()->json(['message' => 'El juego fue eliminada correctamente.']);
        } else {
           
            return redirect()->route('juegos.index');
        }
        
    }
}
