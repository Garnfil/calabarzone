<?php

namespace App\Http\Requests\CityMunicipality;

use Illuminate\Foundation\Http\FormRequest;

class CreateCityMunicipalityRequest extends FormRequest
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
            'featured_image' => 'nullable|image',
            'type' => 'nullable|in:city,municipality',
            'description' => 'nullable',
            'province_id' => 'nullable'
        ];
    }
}
