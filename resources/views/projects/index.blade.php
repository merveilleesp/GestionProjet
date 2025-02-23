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
                            <a href="{{ route('tasks.index', ['project' => $project->id]) }}" class="btn btn-primary">Gérer les tâches</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $project->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event, {{ $project->id }})">Supprimer</button>
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

<script>
    function confirmDelete(event, projectId) {
        event.preventDefault(); // Empêche l'envoi immédiat du formulaire
        const confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce projet ?");
        
        if (confirmation) {
            document.getElementById('delete-form-' + projectId).submit(); // Soumet le formulaire après confirmation
        }
    }
</script>
@endsection
