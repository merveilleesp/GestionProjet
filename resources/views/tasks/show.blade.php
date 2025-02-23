@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de la tâche : {{ $task->title }}</h1>

    <p><strong>Description :</strong> {{ $task->description }}</p>
    <p><strong>Date d'échéance :</strong> {{ $task->due_date }}</p>
    <p><strong>Statut :</strong> {{ $task->status }}</p>

    <p><strong>Assignée à :</strong>
        @if ($task->assigned_to && $task->user)
            {{ $task->user->name }} ({{ $task->user->email }})
        @else
            Non assignée
        @endif
    </p>

    <a href="{{ route('tasks.index', $project->id) }}" class="btn btn-primary">Retour à la liste des tâches</a>
</div>
@endsection
