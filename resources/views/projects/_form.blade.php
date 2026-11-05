<div class="space-y-6">
    <div>
        <x-input-label for="title" value="Título" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                      :value="old('title', $project->title)" required autofocus />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" value="Descripción" />
        <textarea id="description" name="description" rows="4" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $project->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="deadline" value="Fecha límite" />
            <x-text-input id="deadline" name="deadline" type="date" class="mt-1 block w-full"
                          :value="old('deadline', $project->deadline?->format('Y-m-d'))" required />
            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="status" value="Estado" />
            <select id="status" name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach (\App\Models\Project::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $project->status ?? 'pendiente') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
    </div>
</div>