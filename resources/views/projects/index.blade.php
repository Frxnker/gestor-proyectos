<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mis proyectos</h2>
            <a href="{{ route('projects.create') }}">
                <x-primary-button>+ Nuevo proyecto</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($projects->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-12 text-center text-gray-500">
                    Todavía no tienes proyectos.
                    <a href="{{ route('projects.create') }}" class="text-indigo-600 font-medium hover:underline">Crea el primero</a>.
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <a href="{{ route('projects.show', $project) }}"
                           class="block bg-white rounded-xl shadow-sm p-6 hover:shadow-md hover:-translate-y-0.5 transition">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="font-semibold text-lg text-gray-900">{{ $project->title }}</h3>
                                <x-status-badge :status="$project->status" />
                            </div>
                            <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ $project->description }}</p>
                            <div class="mt-4 flex justify-between text-xs text-gray-500">
                                <span>👤 {{ $project->owner->name }}</span>
                                <span>📅 {{ $project->deadline->format('d/m/Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>