@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tableau de Bord') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Afficher les projets de l'utilisateur -->
                    <h3 class="mb-4">Mes Projets</h3>

                    @if ($projects->count() > 0)
                        @foreach ($projects as $project)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>{{ $project->title }}</h4>
                                    <p class="mb-0">{{ $project->description }}</p>
                                    <small>Statut : {{ $project->status }}</small>
                                </div>
                                <div class="card-body">
                                    <h5>Tâches</h5>

                                    @if ($project->tasks->count() > 0)
                                        <ul class="list-group">
                                            @foreach ($project->tasks as $task)
                                                <li class="list-group-item">
                                                    <strong>{{ $task->title }}</strong>
                                                    <p>{{ $task->description }}</p>
                                                    <small>Date d'échéance : {{ $task->due_date }}</small>
                                                    <span class="badge bg-secondary">{{ $task->status }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Aucune tâche pour ce projet.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Vous ne participez à aucun projet pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection