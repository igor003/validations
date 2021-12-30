<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreInterventionRequest extends FormRequest
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
            'date' => 'required',
            'type_mentenance' =>'required',
            'device' => 'required',
            'intervention' =>'required',
            'duration' =>'required',
            'nmb_of_shuts' =>'sometimes|required', 
            'temper' =>'sometimes|required',
            
        ];
    }

  

  
}
