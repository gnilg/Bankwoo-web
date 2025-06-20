<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            // Traitement du formulaire
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            Category::create([
                'name' => $request->name,
                'type' => 'income',
                'description' => $request->description,
            ]);

            return redirect()->route('incomeConfig')->with('success', 'Catégorie ajoutée avec succès');
        }

        // Requête GET : afficher les catégories
        $categories = Category::where('type','income')->latest()->get();
        return view('config.incomeConfig', compact('categories'));
    }

    public function indexSpent(Request $request)
    {
        if ($request->isMethod('post')) {
            // Traitement du formulaire
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            Category::create([
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description,
            ]);

            return redirect()->route('spentConfig')->with('success', 'Catégorie ajoutée avec succès');
        }

        // Requête GET : afficher les catégories
        $categories = Category::where('type', 'expense')->latest()->get();
        return view('config.spentConfig', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('incomeConfig')->with('success', 'Catégorie supprimée avec succès');
    }

    public function destroySpent(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('spentConfig')->with('success', 'Catégorie supprimée avec succès');
    }

}
