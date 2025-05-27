@extends('layouts.app')

@section('title', 'Pokedex')

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4">

    {{-- Contenedor flex para título y formulario de búsqueda --}}
    <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">
        <h1 class="text-3xl font-bold text-red-700">Pokedex</h1>

        <form method="POST" action="{{ route('pokemon.search') }}" class="w-full max-w-md flex gap-2" novalidate>
            @csrf
            <input type="text" name="name" placeholder="Ej: Pikachu" required
                class="flex-grow px-4 py-2 rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
            <button type="submit"
                class="bg-yellow-400 hover:bg-yellow-300 text-black font-semibold py-2 px-4 rounded-lg transition duration-200 whitespace-nowrap">
                Buscar
            </button>
        </form>
    </div>

    {{-- Grid listado Pokémon --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($pokemonList as $pokemon)
            <a href="{{ route('pokemon.show', ['name' => $pokemon['name']]) }}"
               class="block bg-red-600 text-white p-4 rounded-xl shadow transition-all duration-200 hover:scale-105 hover:shadow-2xl hover:bg-red-700 text-center">
               
                {{-- ID del Pokémon --}}
                <p class="text-white/80 text-sm mb-2">#{{ $pokemon['id'] }}</p>

                {{-- Imagen --}}
                <div class="w-32 h-32 mx-auto mb-4 bg-white rounded-full p-4 shadow-inner flex items-center justify-center">
                    <img src="{{ $pokemon['image'] }}" alt="{{ $pokemon['name'] }}" class="max-w-full max-h-full object-contain">
                </div>

                {{-- Nombre --}}
                <p class="capitalize font-semibold text-lg">{{ $pokemon['name'] }}</p>
            </a>
        @endforeach
    </div>

    {{-- Paginación --}}
    <div class="flex justify-center flex-wrap gap-2 mt-10">
        @php
            $lastPage = ceil($total / $perPage);
            $maxPagesToShow = 7;
            $startPage = max(1, $currentPage - floor($maxPagesToShow / 2));
            $endPage = min($lastPage, $startPage + $maxPagesToShow - 1);
            if ($endPage - $startPage < $maxPagesToShow - 1) {
                $startPage = max(1, $endPage - $maxPagesToShow + 1);
            }
        @endphp

        {{-- Botón Primera página --}}
        @if ($currentPage > 1)
            <a href="{{ route('pokemon.index', ['page' => 1]) }}" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">«</a>
        @endif

        {{-- Botón Anterior --}}
        @if ($currentPage > 1)
            <a href="{{ route('pokemon.index', ['page' => $currentPage - 1]) }}" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">‹</a>
        @endif

        {{-- Números páginas --}}
        @for ($i = $startPage; $i <= $endPage; $i++)
            <a href="{{ route('pokemon.index', ['page' => $i]) }}"
               class="px-3 py-1 rounded {{ $i == $currentPage ? 'bg-red-600 text-white font-bold' : 'bg-gray-200 hover:bg-gray-300' }}">
                {{ $i }}
            </a>
        @endfor

        {{-- Botón Siguiente --}}
        @if ($currentPage < $lastPage)
            <a href="{{ route('pokemon.index', ['page' => $currentPage + 1]) }}" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">›</a>
        @endif

        {{-- Botón Última página --}}
        @if ($currentPage < $lastPage)
            <a href="{{ route('pokemon.index', ['page' => $lastPage]) }}" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">»</a>
        @endif
    </div>
</div>
@endsection
