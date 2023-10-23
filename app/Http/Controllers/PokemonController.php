<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{PokemonRequest,ListarPokeRequest};
use App\Models\Pokemon;
use App\Repositories\PokemonRepository;

class PokemonController extends Controller
{   

    public function __construct(PokemonRepository $pokemonRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
    }

    public function index(PokemonRequest $request)
    {   
        return $this->pokemonRepository->registrarPokemon($request);
        // $pokemon = new Pokemon();
        // $pokemon->nombre = $request->nombre;
        // $pokemon->save();

        // return response()->json([
        //     "message" => "Pokemon creado correctamente",
        //     "data" => $pokemon,
        // ], 201);
    }    

    public function actualizarPokemon(PokemonRequest $request){
        return $this->pokemonRepository->updatePokemon($request);
    }

    public function listarPokemon(ListarPokeRequest $request){
        return $this->pokemonRepository->listarPokemon($request);
    }

    public function listarPokemones(){
        return $this->pokemonRepository->listarPokemones();
    }

    public function deletePokemon(ListarPokeRequest $request){
        return $this->pokemonRepository->deletePokemon($request);
    }
}
