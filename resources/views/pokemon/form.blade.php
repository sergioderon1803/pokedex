@extends('layouts.app')

@section('title', 'Search Pokemon')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] px-4">
    <div class="bg-red-600 text-white rounded-2xl shadow-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Buscar Pokémon por nombre</h1>

        <form method="POST" action="{{ route('pokemon.search') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Ej: Pikachu" required
                class="w-full px-4 py-2 rounded-lg bg-white text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
            <button type="submit" 
                class="w-full bg-yellow-400 hover:bg-yellow-300 text-black font-semibold py-2 px-4 rounded-lg transition duration-200">
                Buscar
            </button>
        </form>

        @if ($errors->any())
            <p class="mt-4 text-sm text-yellow-200 bg-white/20 p-2 rounded text-center">
                {{ $errors->first() }}
            </p>
        @endif
    </div>
</div>
@endsection
