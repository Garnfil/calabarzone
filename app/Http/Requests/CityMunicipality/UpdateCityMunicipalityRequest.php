<?php

namespace App\Http\Requests\CityMunicipality;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityMunicipalityRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'required|in:city,municipality',
            'description' => 'required',
            'province_id' => 'required'
        ];
    }
}
