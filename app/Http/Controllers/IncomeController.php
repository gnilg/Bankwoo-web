<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = Income::with('category') // pour avoir le nom de la catégorie
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('income.index', compact('incomes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'income')->get();
        return view('income.create', compact('categories'));
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

        Income::create([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => auth()->user()->id, // l'utilisateur connecté
        ]);

        $user = Auth::user();
        $user->solde += $request->amount;
        $user->save();

        return redirect()->route('income.index')->with('success', 'Revenu ajouté avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        //
    }
}
