<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Spent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spents = Spent::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('spent.index', compact('spents'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'expense')->get();
        return view('spent.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        Spent::create([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => auth()->user()->id, // l'utilisateur connecté
        ]);

        $user = Auth::user();
        $user->solde -= $request->amount;
        $user->save();

        return redirect()->route('spent.index')->with('success', 'Revenu ajouté avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Spent $spent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spent $spent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spent $spent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spent $spent)
    {
        //
    }
}
