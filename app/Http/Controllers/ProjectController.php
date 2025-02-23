<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project; 

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                // Récupérer l'utilisateur connecté
                $user = Auth::user();
                // Récupérer les projets de l'utilisateur
                $projects = $user->projects;
        
                // Passer les projets à la vue
                return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:en attente,en cours,terminé',
        ]);

        
        // Création du projet
        $project = Auth::user()->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        $adminRoleId = 1; 

        if (!$project->users()->where('user_id', Auth::id())->exists()) {
            $project->users()->attach(Auth::id(), ['role_id' => $adminRoleId]);
        }
    

        // Redirection avec un message de succès
        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Trouver le projet par ID
        $project = Project::findOrFail($id);

        // Retourner la vue avec les détails du projet
        return view('projects.show', compact('project'));
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
    public function destroy($id)
    {
        // Trouver le projet par ID
        $project = Project::findOrFail($id);

        // Supprimer les relations dans la table pivot (project_user)
        $project->users()->detach();

        // Supprimer le projet
        $project->delete();

        // Rediriger vers la liste des projets avec un message de succès
        return redirect()->route('projects.index')->with('success', 'Le projet a été supprimé avec succès.');
    }


}
