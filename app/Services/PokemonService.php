<?php



namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;


class PokemonService{
    public function cargarPokemones(){
        try {
            $response = Http::get('https://pokeapi.co/api/v2/generation/1');
            if($response->successful()){

                // hacer un for each para guardar los pokemones en la base de datos

                return ['body'=>$response->json(),'status'=>$response->status()];
            }
            if($response->failed()){
                return ['body'=>'Fallo de Informacion','status'=>$response->status()];

            }

            if($response->clientError()){
                return ['body'=>'Fallo de Comunicacion','status'=>$response->status()];

            }

        } catch (Exception $e) {
            return response()->json(
                [
                    'erorr' => $e->getMessage(),
                    'linea' => $e->getLine(),
                    'file' => $e->getFile(),
                    'metodo' => $e->__METHOD__
                ],Response::HTTP_BAD_REQUEST
                );
        }
    }

     public function CargarRegiones($id){
        try{
            $response = Http::get('https://pokeapi.co/api/v2/generation/'.$id);


            if($response->successful()){
                return ["body"=>$response->json(), "status"=> $response->status()];
            }
            if($response->failed()){
                return ["body"=>"fallo de informacion", "status"=> $response->status()];

            }
            if($response->clientError()){
                return ["body"=>" fallo de comunicacion", "status"=> $response->status()];

            }
        
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                 "linea"=> $e->getLine(), 
                 "file"=> $e->getFile(),
                 "metodo"=> __METHOD__
        ], Response::HTTP_BAD_REQUEST);
        }
    }
}