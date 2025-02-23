@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Détails du projet</h1>

    <!-- Afficher les détails du projet -->
    <div class="card">
        <div class="card-header">
            <h5>{{ $project->title }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4"><strong>Nom du projet :</strong></div>
                <div class="col-md-8">{{ $project->title }}</div>
            </div>
            <div class="row">
                <div class="col-md-4"><strong>Description :</strong></div>
                <div class="col-md-8">{{ $project->description ?? 'Aucune description' }}</div>
            </div>
            <div class="row">
                <div class="col-md-4"><strong>Date de début :</strong></div>
                <div class="col-md-8">{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</div>
            </div>
            <div class="row">
                <div class="col-md-4"><strong>Date de fin :</strong></div>
                <div class="col-md-8">
                    {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') : 'Non spécifiée' }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><strong>Statut :</strong></div>
                <div class="col-md-8">{{ $project->status }}</div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
    <h3>Tâches associées</h3>
    @if ($project->tasks->count() > 0)
        <ul>
            @foreach ($project->tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong><br>
                    Description: {{ $task->description }}<br>
                    Statut: {{ $task->status }}<br>
                    Date d'échéance: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') : 'Non définie' }}<br>
                    Assignée à: {{ $task->assigned_to ? $task->user->name : 'Non assignée' }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune tâche associée à ce projet.</p>
    @endif
</div>
@endsection
