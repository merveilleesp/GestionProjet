@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des Projets</h1>

    <!-- Lien pour créer un nouveau projet -->
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-4">Créer un nouveau projet</a>

    <!-- Afficher la liste des projets -->
    @if ($projects->count() > 0)
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $project->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $project->description }}</p>
                            <small>Statut : {{ $project->status }}</small>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info">Voir les détails</a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Vous n'avez aucun projet pour le moment.</p>
    @endif
</div>
@endsection