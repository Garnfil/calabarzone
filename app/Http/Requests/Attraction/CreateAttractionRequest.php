<?php

namespace App\Http\Requests\Attraction;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttractionRequest extends FormRequest
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
            'attraction_name' => 'required',
            'featured_image' => 'nullable|image',
            'province_id' => 'nullable',
            'city_id' => 'nullable',
            'how_to_get_there' => 'nullable',
            'interest_type' => 'nullable',
            'description' => 'nullable',
            'things_todo' => 'nullable',
            'operational_hours' => 'nullable',
            'best_time_to_visit' => 'nullable',
            'contact_number' => 'nullable',
            'mobile_number' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable'
        ];
    }
}
