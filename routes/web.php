<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpentController;
use App\Models\Category;
use App\Models\Income;
use App\Models\Spent;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/dashboard', function () {
    $incomeCategories = Category::where('type', 'income')->get();

    $labels = $incomeCategories->pluck('name');
    $values = [];

    foreach ($incomeCategories as $category) {
        $total = Income::where('category_id', $category->id)->sum('amount');
        $values[] = $total;
    }

    $monthIncome = Income::whereMonth('created_at', date('m'))->
    whereYear('created_at', date('Y'))->
    sum('amount');

    $monthSpent = Spent::whereMonth('created_at', date('m'))->
    whereYear('created_at', date('Y'))->
    sum('amount');

    $yearIncome = Income::whereYear('created_at', date('Y'))->sum('amount');
    $yearSpent = Spent::whereYear('created_at', date('Y'))->sum('amount');

    $incomes = Income::with('category')->get()->map(function ($item) {
        return [
            'amount' => $item->amount,
            'created_at' => $item->created_at,
            'category_name' => $item->category->name ?? 'N/A',
            'type' => $item->category->type ?? 'income',
        ];
    });

    $spents = Spent::with('category')->get()->map(function ($item) {
        return [
            'amount' => $item->amount,
            'created_at' => $item->created_at,
            'category_name' => $item->category->name ?? 'N/A',
            'type' => $item->category->type ?? 'expense',
        ];
    });

    $transactions = $incomes->merge($spents)->sortByDesc('created_at')->values();



    return view('dashboard', [
        'data' => [
            'labels' => $labels,
            'values' => $values,
        ],
        'monthData'=>[
            'income' => $monthIncome,
            'spent' => $monthSpent,
            'yearIncome'=>$yearIncome,
            'yearSpent'=>$yearSpent,

        ],
        'transactions' =>$transactions
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('income', IncomeController::class);
    Route::resource('spent', SpentController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::match(['get', 'post','delete'], 'incomeConfig',[ConfigController::class,'index'])->name('incomeConfig');
    Route::match(['get', 'post','delete'], 'spentConfig',[ConfigController::class,'indexSpent'])->name('spentConfig');
    Route::delete('incomeConfig/{id}', [ConfigController::class, 'destroy'])->name('incomeConfig.destroy');
    Route::delete('spentConfig/{id}', [ConfigController::class, 'destroySpent'])->name('spentConfig.destroy');

});

require __DIR__.'/auth.php';
