@props(['status'])

@php
    $colors = [
        'pendiente' => 'bg-yellow-100 text-yellow-800',
        'en_progreso' => 'bg-blue-100 text-blue-800',
        'completado' => 'bg-green-100 text-green-800',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold ' . ($colors[$status] ?? 'bg-gray-100 text-gray-800')]) }}>
    {{ \App\Models\Project::STATUSES[$status] ?? $status }}
</span>