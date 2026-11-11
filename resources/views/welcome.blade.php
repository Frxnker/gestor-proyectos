<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} · Gestión de proyectos colaborativos</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

    {{-- Barra superior --}}
    <header class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 font-bold text-lg text-gray-900">
            <x-application-logo class="h-8 w-8 fill-current text-indigo-600" />
            Gestor de Proyectos
        </a>
        <nav class="flex items-center gap-3">
            @auth
                <a href="{{ route('projects.index') }}"
                   class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                    Ir a mis proyectos
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                   class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                    Crear cuenta
                </a>
            @endauth
        </nav>
    </header>

    {{-- Hero --}}
    <section class="max-w-7xl mx-auto px-6 pt-16 pb-24 text-center">
        <span class="inline-block rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
            Trabajo en equipo, sin líos
        </span>
        <h1 class="mt-6 text-4xl sm:text-6xl font-extrabold tracking-tight text-gray-900">
            Organiza tus proyectos<br>
            <span class="text-indigo-600">y a tu equipo</span> en un solo lugar
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
            Crea proyectos, invita a tus compañeros con un rol concreto y lleva el control
            de las horas que dedica cada uno. Simple, rápido y visual.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('register') }}"
               class="rounded-lg bg-indigo-600 px-8 py-3 font-semibold text-white shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">
                Empieza gratis
            </a>
            <a href="{{ route('login') }}"
               class="rounded-lg border border-gray-300 bg-white px-8 py-3 font-semibold text-gray-700 hover:border-indigo-400 hover:text-indigo-600 transition">
                Ya tengo cuenta
            </a>
        </div>
    </section>

    {{-- Características --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-center text-3xl font-bold text-gray-900">Todo lo que necesitas</h2>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-8">
                    <div class="text-3xl">📁</div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Proyectos claros</h3>
                    <p class="mt-2 text-gray-600">Define título, descripción, fecha límite y estado. Visualiza todo de un vistazo.</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-8">
                    <div class="text-3xl">👥</div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Equipos con roles</h3>
                    <p class="mt-2 text-gray-600">Añade participantes como Desarrollador, Diseñador o Tester según lo que aporte cada uno.</p>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-8">
                    <div class="text-3xl">⏱️</div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Control de horas</h3>
                    <p class="mt-2 text-gray-600">Registra las horas de trabajo de cada participante y mantén el proyecto bajo control.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Llamada final --}}
    <section class="max-w-4xl mx-auto px-6 py-20 text-center">
        <div class="rounded-3xl bg-indigo-600 px-8 py-14 text-white shadow-xl">
            <h2 class="text-3xl font-bold">¿Listo para empezar?</h2>
            <p class="mt-3 text-indigo-100">Crea tu cuenta en menos de un minuto y monta tu primer proyecto.</p>
            <a href="{{ route('register') }}"
               class="mt-8 inline-block rounded-lg bg-white px-8 py-3 font-semibold text-indigo-600 hover:bg-indigo-50 transition">
                Crear mi cuenta
            </a>
        </div>
    </section>

    <footer class="border-t border-gray-200 py-8 text-center text-sm text-gray-500">
        © {{ date('Y') }} Gestor de Proyectos · Francisco López Lobanova · 2º DAW IES Celia Viñas
    </footer>
</body>
</html>