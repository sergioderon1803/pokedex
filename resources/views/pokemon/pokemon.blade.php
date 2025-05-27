@extends('layouts.app')

@section('title', ucfirst($pokemon['name']))

@section('content')
<div class="max-w-xl mx-auto bg-red-700 text-white rounded-2xl shadow-lg p-6 mt-10">
    <div class="text-center">
        <p class="text-sm text-white/80">#{{ $pokemon['id'] }}</p>
        <h1 class="text-3xl font-bold">{{ ucfirst($pokemon['name']) }}</h1>
        <div class="w-40 h-40 mx-auto mt-4 bg-white rounded-full p-4 shadow-inner flex items-center justify-center">
            <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="max-w-full max-h-full object-contain">
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-xl font-semibold border-b border-white/50 pb-1 mb-2">Tipos</h3>
        <ul class="grid grid-cols-2 gap-2">
            @foreach ($pokemon['types'] as $type)
                <li class="bg-white/20 rounded-lg px-3 py-1 text-center capitalize">{{ $type['type']['name'] }}</li>
            @endforeach
        </ul>
    </div>

    <div class="mt-6">
        <h3 class="text-xl font-semibold border-b border-white/50 pb-1 mb-2">Habilidades</h3>
        <ul class="grid grid-cols-1 gap-2">
            @foreach ($pokemon['abilities'] as $ability)
                <li class="bg-white/20 rounded-lg px-3 py-1 capitalize">{{ $ability['ability']['name'] }}</li>
            @endforeach
        </ul>
    </div>

    <div class="mt-6">
        <h3 class="text-xl font-semibold border-b border-white/50 pb-1 mb-2">Estadísticas</h3>
        <ul class="space-y-2">
            @foreach ($pokemon['stats'] as $stat)
                <li class="flex justify-between bg-white/20 rounded-lg px-3 py-1 capitalize">
                    <span>{{ $stat['stat']['name'] }}</span>
                    <span>{{ $stat['base_stat'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
