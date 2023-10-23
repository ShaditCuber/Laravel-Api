<?php

namespace App\Repositories;

use App\Models\Pokemon;
use Illuminate\Http\Response;
use Iluminate\Support\Facades\Log;
use Exception;




class PokemonRepository
{
    public function registrarPokemon($request)
    {
       try {
        $pokemon = new Pokemon();
        $pokemon->nombre = $request->nombre;
        $pokemon->save();
        return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
       } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), 'linea' => $e-> getLine() ], Response::HTTP_BAD_REQUEST);
       }
    }

    public function updatePokemon($request){
        try {
            $pokemon = Pokemon::findorFail($request->id);
            $pokemon->nombre = $request->nombre;
            $pokemon->save();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
           } catch (Exception $e) {
                return response()->json(["message" => $e->getMessage(), 'linea' => $e-> getLine() ], Response::HTTP_BAD_REQUEST);
           }
    }

    public function listarPokemon($request){
        try {
            $pokemon = Pokemon::findorFail($request->id);
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), 'linea' => $e-> getLine() ,'file' => $e->getFile(), 'metodo' => $e-> __METHOD__ ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarPokemones(){
        try {
            $pokemon = Pokemon::where('id', '>', 2)->paginate(2);
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), 'linea' => $e-> getLine() ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function deletePokemon($request){
        try {
            $pokemon = Pokemon::findorFail($request->id);
            $pokemon->delete();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), 'linea' => $e-> getLine() ], Response::HTTP_BAD_REQUEST);
        }
    }
}

// wherein
// wherebetween
// where -> where 
// findorfail -> sirve para buscar por id y si no encuentra lanza una excepcion
// find -> sirve para buscar por id y si no encuentra retorna null
