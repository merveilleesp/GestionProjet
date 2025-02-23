@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des Tâches pour le projet : {{ $project->title }}</h1>

    <!-- Lien pour créer une nouvelle tâche -->
    <a href="{{ route('tasks.create', $project->id) }}" class="btn btn-primary mb-4">Créer une nouvelle tâche</a>

    <!-- Afficher la liste des tâches -->
    @if ($tasks->count() > 0)
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item">
                    <h5>{{ $task->title }}</h5>
                    <p>{{ $task->description }}</p>
                    <small>Date d'échéance : {{ $task->due_date }}</small> <br>
                    <small>Statut : {{ $task->status }}</small>

                    <div class="mt-2">
                        <a href="{{ route('tasks.show', ['project' => $project->id, 'task' => $task->id]) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('tasks.edit', [$project->id, $task->id]) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('tasks.destroy', ['task' => $task->id, 'project' => $project->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cette tâche ?')">Supprimer</button>
                        </form>


                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune tâche trouvée.</p>
    @endif
</div>
@endsection
