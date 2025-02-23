@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Créer un Projet</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">Nouveau Projet</div>
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                <!-- Titre -->
                <div class="mb-3">
                    <label for="title" class="form-label">Titre du projet</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <!-- Date de début -->
                <div class="mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                </div>

                <!-- Date de fin -->
                <div class="mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                </div>

                <!-- Statut -->
                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-control">
                        <option value="en attente">En attente</option>
                        <option value="en cours">En cours</option>
                        <option value="terminé">Terminé</option>
                    </select>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Créer le projet</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
