<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar proyecto</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('projects.update', $project) }}">
                    @csrf
                    @method('PUT')
                    @include('projects._form')

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('projects.show', $project) }}">
                            <x-secondary-button type="button">Cancelar</x-secondary-button>
                        </a>
                        <x-primary-button>Guardar cambios</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>