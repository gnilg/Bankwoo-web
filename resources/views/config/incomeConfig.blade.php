@extends('layouts.app')

@section('title', 'Catégories de revenu')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Configurations des revenus</h1>
    {{-- <a href="{{ route('income.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Listes
    </a> --}}
</div>

<div class="row">
    {{-- Formulaire d’ajout --}}
    <div class="col-12 col-md-5">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0">Ajouter un type de revenu</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('incomeConfig') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Nom</label>
                        <input type="text" name="name" class="form-control" required placeholder="Ex : Salaire">
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="(optionnel)"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Liste des catégories --}}
    <div class="col-12 col-md-7">
        <div class="card shadow mb-4">
            <div class="card-header bg-secondary text-white">
                <h6 class="m-0">Liste des catégories</h6>
            </div>
            <div class="card-body">
                @if($categories->count())
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                                <tr>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ $cat->description }}</td>
                                    <td>
                                        <form action="{{ route('incomeConfig.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- Tu peux aussi ajouter un bouton "modifier" ici --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Aucune catégorie pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
