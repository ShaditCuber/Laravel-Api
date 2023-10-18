<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            "nombre" => "required|unique:pokemon|string", 
            // "despide" => "required",
        ];
    }

    public function messages(){
        return [
            "required" => "El :attribute es requerido",
            "unique" => "El :attribute ya existe",
            "string" => "El :attribute debe ser un texto",
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            "errors" => $validator->errors(),
        ], 400);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
