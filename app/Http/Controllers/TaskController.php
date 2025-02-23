<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks;  // Assure-toi que tu récupères bien les tâches du projet
        return view('tasks.index', compact('tasks', 'project'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId); // Vérifie que le projet existe
        $users = User::all(); // Récupérer tous les utilisateurs

        return view('tasks.create', compact('project', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $projectId)
    {
        // Validation des autres champs de la tâche
    
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->project_id = $projectId;  // Associer la tâche au projet
    
        // Si un email est fourni, chercher l'utilisateur et lui assigner la tâche
        if ($request->assigned_to) {
            // Trouver l'utilisateur par email
            $user = User::where('email', $request->assigned_to)->first();
    
            // Si l'utilisateur existe, assigner son ID à la tâche
            if ($user) {
                $task->assigned_to = $user->id;
            } else {
                // Si aucun utilisateur trouvé, tu peux gérer l'erreur ici si nécessaire
                return redirect()->back()->with('error', 'Utilisateur non trouvé');
            }
        }
    
        // Sauvegarder la tâche
        $task->save();
    
        // Retourner à la page de projet avec succès
        return redirect()->route('tasks.index', ['project' => $projectId])
            ->with('success', 'Tâche créée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId); // Trouver le projet
        $task = Task::findOrFail($taskId); // Trouver la tâche

        return view('tasks.show', compact('project', 'task')); // Retourner la vue avec les détails
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($taskId)
    {
        // Trouver la tâche
        $task = Task::findOrFail($taskId);

        // Supprimer la tâche
        $task->delete();

        // Rediriger après suppression
        return redirect()->route('projects.tasks.index', $task->project_id)
                        ->with('success', 'La tâche a été supprimée.');
    }


}
