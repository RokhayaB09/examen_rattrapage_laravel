<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animals = Animal::all();
        return response()->json($animals, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'status' => 'nullable|string|in:DISPONIBLE,ADOPTE,EN SOIN'
        ]);
        $validated['status'] = $validated['status'] ?? 'DISPONIBLE';
        $animal = Animal::create($validated);
        return response()->json($animal, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:DISPONIBLE,ADOPTE,EN SOIN'
        ]);
        $animal->update($validated);
        return response()->json($animal);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
