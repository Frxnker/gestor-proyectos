<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'status'];

    protected function casts(): array
    {
        return ['deadline' => 'date'];
    }

    public const STATUSES = [
        'pendiente' => 'Pendiente',
        'en_progreso' => 'En progreso',
        'completado' => 'Completado',
    ];

    // 1:N — el propietario del proyecto
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // N:N — participantes, con los datos extra de la pivote
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'contribution_hours')
            ->withTimestamps();
    }
}