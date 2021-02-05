<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class locationResquest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
           'dateStart'=>'required|date|after_or_equal:today',
            'nbDay'=>'required|integer',
            'idVehicle' => 'required|integer',
        ];
    }
}
