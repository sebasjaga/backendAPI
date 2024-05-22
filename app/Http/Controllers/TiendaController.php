<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tienda = Tienda::all();
      
            return response()->json([
                'status' => true,
                'tienda' => $tienda
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tienda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tienda = Tienda::create($request->all());

            if ($request->expectsJson()) {
                // Si la solicitud es una API, devolver una respuesta JSON
                return response()->json([
                    'status' => true,
                    'message' => "tienda Creada!",
                    'tienda' => $tienda
                ], 200);
            } else {
                // dd($request->expectsJson());
                // Si la solicitud es de la web, devolver una vista
                return redirect()->route('tienda.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear tienda"
                // 'tienda' => $tienda
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
        $tienda = Tienda::find($id);

        return view('tienda.edit', compact('tienda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $tienda = Tienda::find($id);

            if (!$tienda) {
                return response()->json(['error' => 'La tienda no existe.'], 404);
            }
        
            $tienda->update($request->all());
        

            if ($request->expectsJson()) {

                return response()->json([
                    'status' => true,
                    'message' => "tienda Creada!",
                    'tienda' => $tienda
                ], 200);
            } else {
                return redirect()->route('tienda.index');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => "Error al crear tienda"
                // 'tienda' => $tienda
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $tienda = Tienda::find($id);
       
        if (!$tienda) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'La tienda no existe.'], 404);
            }
        }

        $tienda->delete();
       
        if ($request->expectsJson()) {
            return response()->json(['message' => 'La tienda fue eliminada correctamente.']);
        } else {
           
            return redirect()->route('tienda.index');
        }
        
    }
}
