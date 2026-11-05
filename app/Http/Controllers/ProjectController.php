<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
// (los imports de Project, StoreProjectRequest y UpdateProjectRequest ya vienen generados)

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Proyectos que he creado o en los que participo
        $projects = Project::where('user_id', $user->id)
            ->orWhereHas('members', fn ($query) => $query->where('users.id', $user->id))
            ->with('owner')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create', ['project' => new Project]);
    }

    public function store(StoreProjectRequest $request)
    {
        $request->user()->ownedProjects()->create($request->validated());

        return redirect()->route('projects.index')->with('success', 'Proyecto creado correctamente.');
    }

    public function show(Project $project)
    {
        $project->load(['owner', 'members']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect()->route('projects.show', $project)->with('success', 'Proyecto actualizado.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado.');
    }
}
