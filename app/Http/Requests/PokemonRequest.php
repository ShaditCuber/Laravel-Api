<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;


class PokemonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "id" => "nullable|exists:pokemon,id|integer",
            "nombre" => "required|unique:pokemon|string", 
            "region" => "required|exists:regions,reg_nombre"

            // "despide" => "required",
        ];
    }

    public function messages(){
        return [
            "required" => "El :attribute es requerido",
            "unique" => "El :attribute ya existe",
            "string" => "El :attribute debe ser un texto",
            "exists" => "El :attribute no existe",
        ];
    }

     protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all(), Response::HTTP_I_AM_A_TEAPOT)
        );
    }

    
}
