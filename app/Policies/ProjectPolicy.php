<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    // Ver el detalle: el propietario o un participante
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->user_id
            || $project->members->contains($user);
    }

    // Editar y gestionar participantes: solo el propietario
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    // Borrar: solo el propietario
    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }
}