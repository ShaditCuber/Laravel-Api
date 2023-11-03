<?php

namespace App\Repositories;

use App\Models\{Pokemon, Region};

use Illuminate\Http\Response;
use Exception;
use App\Services\PokemonService;
use Illuminate\Support\Facades\Log;


class PokemonRepository
{
    public function registrarPokemon($request)
    {
        try {
            $region= Region::where('reg_nombre', $request->region)->first();

            $pokemon = new Pokemon();
            $pokemon->nombre = $request->nombre;
            $pokemon->region_id = $region->id;
            $pokemon->save();
            return response()->json(["pokemon" => $pokemon], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                 "linea"=> $e->getLine(), 
                 "file"=> $e->getFile(),
                 "metodo"=> __METHOD__
        ], Response::HTTP_BAD_REQUEST);
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
            // $pokemon = Pokemon::where('id', '>', 2)->paginate(2);
            // mostrar todos los pokemones con paginacion
            $pokemon = Pokemon::paginate(2);
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

    


    public function cargarPokemones(){
        try {
            for ($i = 1; $i <= 9; $i++) {
                $pokemonServiceRegion = new PokemonService;
                $pokemones = $pokemonServiceRegion->CargarRegiones($i);
                // ver si la region existe
                $existe = Region::where('region_name', $pokemones['body']['main_region']['name'])->first();
                if($existe){
                    continue;
                }else{
                    $region = new Region();
                    $region->region_name = $pokemones['body']['main_region']['name'];
                    $region->save();
                    foreach ($pokemones['body']['pokemon_species'] as $pokemon){
                        $poke = new Pokemon();
                        $poke->nombre = $pokemon['name'];
                        $poke->region_id = $region->id;
                        $poke->save();
                    }
                    }

                
            }
            // foreach ($response['body']['results'] as $key) {
            //     Log::info($key['name']);

            //     $existe = Pokemon::where('nombre', $key['name'])->first();
            //     if($existe){
            //         continue;
            //     }else{
            //         $pokemon = new Pokemon();
            //         $pokemon->nombre = $key['name'];
            //         $pokemon->save();
            //     }
            // }


            return response()->json(["body" => 'Exito'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), 'linea' => $e-> getLine() ,'file' => $e->getFile() ], Response::HTTP_BAD_REQUEST);
        }
    }
}

// wherein
// wherebetween
// where -> where 
// findorfail -> sirve para buscar por id y si no encuentra lanza una excepcion
// find -> sirve para buscar por id y si no encuentra retorna null