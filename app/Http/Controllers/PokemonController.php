<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PokemonRequest;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    public function index(PokemonRequest $request)
    {   
        $pokemon = new Pokemon();
        $pokemon->nombre = $request->nombre;
        $pokemon->save();

        return response()->json([
            "message" => "Pokemon creado correctamente",
            "data" => $pokemon,
        ], 201);
    }    
}
