<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    
    protected $apiUrl;
    protected $client;

    public function __construct()
    {
        $this->apiUrl = 'https://pokeapi.co/api/v2/pokemon/';
        // Crear cliente Guzzle con SSL desactivado (no recomendado en producción)
        $this->client = new Client(['verify' => false]);
    }

    public function index(Request $request)
    {
        $limit = 20;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        $response = $this->client->get($this->apiUrl . "?offset={$offset}&limit={$limit}");
        $data = json_decode($response->getBody(), true);

        $pokemonList = collect($data['results'])->map(function ($pokemon, $index) use ($offset) {
            $id = $offset + $index + 1;
            $pokemon['id'] = $id;
            $pokemon['image'] = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$id}.png";
            return $pokemon;
        });

        return view('pokemon.index', [
            'pokemonList' => $pokemonList,
            'currentPage' => $page,
            'perPage' => $limit,
            'total' => $data['count']
        ]);
    }

    public function show($name)
    {
        $response = $this->client->get($this->apiUrl . $name);

        $pokemon = json_decode($response->getBody(), true);
        return view('pokemon.pokemon', compact('pokemon'));
    }

    // Formulario de búsqueda por nombre
    public function searchForm()
    {
        return view('pokemon.form');
    }

    // Buscar por nombre
    public function searchByName(Request $request)
    {
        $name = strtolower($request->input('name'));
        return redirect()->route('pokemon.show', compact('name'));
    }
}
