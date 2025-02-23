@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Créer une nouvelle tâche pour le projet : {{ $project->title }}</h1>

    <form action="{{ route('tasks.store', ['project' => $project->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre de la tâche</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Date d'échéance</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control" required>
                <option value="en cours">En cours</option>
                <option value="terminée">Terminée</option>
                <option value="suspendue">Suspendue</option>
            </select>
        </div>
        <div class="form-group">
            <label for="assigned_to">Assigner à un utilisateur (Email)</label>
            <input type="email" name="assigned_to" id="assigned_to" class="form-control" placeholder="Entrez l'email de l'utilisateur">
        </div>
        <button type="submit" class="btn btn-success">Créer la tâche</button>
    </form>
</div>
@endsection
