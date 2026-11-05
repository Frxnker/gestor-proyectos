<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->title }}</h2>
            <div class="flex gap-3">
                <a href="{{ route('projects.edit', $project) }}">
                    <x-secondary-button>Editar</x-secondary-button>
                </a>
                <form method="POST" action="{{ route('projects.destroy', $project) }}"
                      onsubmit="return confirm('¿Seguro que quieres eliminar este proyecto?')">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>Eliminar</x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm rounded-xl p-6">
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                    <x-status-badge :status="$project->status" />
                    <span>👤 Propietario: <strong class="text-gray-800">{{ $project->owner->name }}</strong></span>
                    <span>📅 Fecha límite: <strong class="text-gray-800">{{ $project->deadline->format('d/m/Y') }}</strong></span>
                </div>
                <p class="mt-4 text-gray-700 whitespace-pre-line">{{ $project->description }}</p>
            </div>

            <div class="bg-white shadow-sm rounded-xl p-6">
                <h3 class="font-semibold text-lg text-gray-900 mb-4">Participantes</h3>

                @if ($project->members->isEmpty())
                    <p class="text-sm text-gray-500">Aún no hay participantes en este proyecto.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-left text-gray-600">
                            <tr>
                                <th class="px-4 py-2 font-medium">Nombre</th>
                                <th class="px-4 py-2 font-medium">Rol</th>
                                <th class="px-4 py-2 font-medium text-right">Horas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($project->members as $member)
                                <tr>
                                    <td class="px-4 py-2">{{ $member->name }}</td>
                                    <td class="px-4 py-2">{{ $member->pivot->role }}</td>
                                    <td class="px-4 py-2 text-right">{{ $member->pivot->contribution_hours }} h</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>