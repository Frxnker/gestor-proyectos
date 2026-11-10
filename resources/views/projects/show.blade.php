<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->title }}</h2>
            <div class="flex gap-3">
                @can('update', $project)
                    <a href="{{ route('projects.edit', $project) }}">
                        <x-secondary-button>Editar</x-secondary-button>
                    </a>
                @endcan
                @can('delete', $project)
                    <form method="POST" action="{{ route('projects.destroy', $project) }}"
                          onsubmit="return confirm('¿Seguro que quieres eliminar este proyecto?')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Eliminar</x-danger-button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Datos del proyecto --}}
            <div class="bg-white shadow-sm rounded-xl p-6">
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                    <x-status-badge :status="$project->status" />
                    <span>👤 Propietario: <strong class="text-gray-800">{{ $project->owner->name }}</strong></span>
                    <span>📅 Fecha límite: <strong class="text-gray-800">{{ $project->deadline->format('d/m/Y') }}</strong></span>
                </div>
                <p class="mt-4 text-gray-700 whitespace-pre-line">{{ $project->description }}</p>
            </div>

            {{-- Participantes --}}
            <div class="bg-white shadow-sm rounded-xl p-6">
                <h3 class="font-semibold text-lg text-gray-900 mb-4">Participantes</h3>

                @if ($project->members->isEmpty())
                    <p class="text-sm text-gray-500">Aún no hay participantes en este proyecto.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-left text-gray-600">
                                <tr>
                                    <th class="px-4 py-2 font-medium">Nombre</th>
                                    <th class="px-4 py-2 font-medium">Rol y horas</th>
                                    @can('update', $project)
                                        <th class="px-4 py-2"></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($project->members as $member)
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-gray-800">{{ $member->name }}</td>
                                        <td class="px-4 py-3">
                                            @can('update', $project)
                                                <form method="POST" action="{{ route('projects.members.update', [$project, $member]) }}"
                                                      class="flex flex-wrap items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="role" class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                        @foreach (\App\Models\Project::ROLES as $role)
                                                            <option value="{{ $role }}" @selected($member->pivot->role === $role)>{{ $role }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="number" name="contribution_hours" step="0.25" min="0"
                                                           value="{{ $member->pivot->contribution_hours }}"
                                                           class="w-24 rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    <span class="text-gray-500">h</span>
                                                    <x-secondary-button type="submit">Guardar</x-secondary-button>
                                                </form>
                                            @else
                                                <span class="text-gray-700">{{ $member->pivot->role }}</span>
                                                <span class="text-gray-500">· {{ $member->pivot->contribution_hours }} h</span>
                                            @endcan
                                        </td>
                                        @can('update', $project)
                                            <td class="px-4 py-3 text-right">
                                                <form method="POST" action="{{ route('projects.members.destroy', [$project, $member]) }}"
                                                      onsubmit="return confirm('¿Quitar a {{ $member->name }} del proyecto?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-sm text-red-600 hover:underline">Quitar</button>
                                                </form>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- Añadir participante (solo propietario) --}}
                @can('update', $project)
                    <div class="mt-8 border-t pt-6">
                        <h4 class="font-medium text-gray-900 mb-3">Añadir participante</h4>

                        @if ($availableUsers->isEmpty())
                            <p class="text-sm text-gray-500">No quedan usuarios disponibles para añadir.</p>
                        @else
                            <form method="POST" action="{{ route('projects.members.store', $project) }}"
                                  class="grid gap-4 sm:grid-cols-4 sm:items-end">
                                @csrf
                                <div>
                                    <x-input-label for="user_id" value="Usuario" />
                                    <select id="user_id" name="user_id" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach ($availableUsers as $user)
                                            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="role" value="Rol" />
                                    <select id="role" name="role" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @foreach (\App\Models\Project::ROLES as $role)
                                            <option value="{{ $role }}" @selected(old('role') === $role)>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="contribution_hours" value="Horas" />
                                    <x-text-input id="contribution_hours" name="contribution_hours" type="number" step="0.25" min="0"
                                                  class="mt-1 block w-full" :value="old('contribution_hours', 0)" required />
                                    <x-input-error :messages="$errors->get('contribution_hours')" class="mt-2" />
                                </div>
                                <div>
                                    <x-primary-button class="w-full justify-center">Añadir</x-primary-button>
                                </div>
                            </form>
                        @endif
                    </div>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>