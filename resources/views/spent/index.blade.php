@extends('layouts.app')
@section('title','Liste des Depenses')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Depenses</h1>
    <a href="{{route('spent.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Ajouter une depense </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List des Depenses</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Opération</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Description</th>
                        <th>Statut</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($spents as $spent)
                        <tr>
                            <td>{{ $spent->created_at->format('d/m/Y') }}</td>
                            <td>{{ $spent->category?->type == 'income' ? 'crédit' : 'débit'}}</td>
                            <td>{{ $spent->category->name ?? 'Non défini' }}</td>
                            <td>{{ number_format($spent->amount, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $spent->description }}</td>
                            <td>
                                <form action="{{ route('spent.destroy', $spent->id) }}" method="POST" onsubmit="return confirm('Supprimer cette depense ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
