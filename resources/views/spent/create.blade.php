@extends('layouts.app')

@section('title', 'Ajouter depense')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">depenses</h1>
    <a href="{{ route('income.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Listes
    </a>
</div>

<div class="row justify">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card border-left-primary shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Information de la depense</h6>
            </div>
            <div class="card-body ">
                <form action="{{ route('spent.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="category_id">Type de depense</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Choisir un type de depense --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount">Montant</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="py-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-plus fa-sm"></i> Ajouter la depense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
