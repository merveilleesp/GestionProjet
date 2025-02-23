<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Notifications\TaskAssignedNotification;


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
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|string',
            'assigned_to' => 'nullable|email' // Assurez-vous que c'est un email
        ]);

        $task = new Task();
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->due_date = $validated['due_date'];
        $task->status = $validated['status'];
        $task->project_id = $project->id;

        // Vérifie si un utilisateur avec cet email existe
        if (!empty($validated['assigned_to'])) {
            $user = User::where('email', $validated['assigned_to'])->first();
            if ($user) {
                $task->assigned_to = $user->id;
            }
        }

        $task->save();

        // Envoie la notification à l'utilisateur assigné si trouvé
        if (isset($user)) {
            $user->notify(new TaskAssignedNotification($task));
        }

        return redirect()->route('tasks.index', $project->id)
                        ->with('success', 'Tâche créée avec succès');
    }




    /**
     * Display the specified resource.
     */
    public function show($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId); // Trouver le projet
        $task = Task::findOrFail($taskId); // Trouver la tâche

        $task = Task::with('assignedUser')->find($taskId);

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
        // Vérifier si l'ID est bien reçu
        if (!$taskId) {
            return redirect()->back()->with('error', 'ID de la tâche invalide.');
        }

        // Trouver la tâche en base de données
        $task = Task::find($taskId);

        // Vérifier si la tâche existe
        if (!$task) {
            return redirect()->back()->with('error', 'Tâche non trouvée.');
        }

        // Récupérer l'ID du projet avant suppression pour la redirection
        $projectId = $task->project_id;

        // Supprimer la tâche
        $task->delete();

        // Rediriger vers la liste des tâches du projet avec un message de succès
        return redirect()->route('tasks.index', ['project' => $projectId])
                        ->with('success', 'La tâche a été supprimée avec succès.');
    }

    

}
