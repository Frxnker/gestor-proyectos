<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectMemberController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::notIn([$project->user_id]),
                Rule::unique('project_user')->where('project_id', $project->id),
            ],
            'role' => ['required', Rule::in(Project::ROLES)],
            'contribution_hours' => ['required', 'numeric', 'min:0', 'max:9999.99'],
        ]);

        $project->members()->attach($validated['user_id'], [
            'role' => $validated['role'],
            'contribution_hours' => $validated['contribution_hours'],
        ]);

        return back()->with('success', 'Participante añadido.');
    }

    public function update(Request $request, Project $project, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(Project::ROLES)],
            'contribution_hours' => ['required', 'numeric', 'min:0', 'max:9999.99'],
        ]);

        $project->members()->updateExistingPivot($user->id, $validated);

        return back()->with('success', "Datos de {$user->name} actualizados.");
    }

    public function destroy(Project $project, User $user)
    {
        $project->members()->detach($user->id);

        return back()->with('success', "{$user->name} ya no participa en el proyecto.");
    }
}