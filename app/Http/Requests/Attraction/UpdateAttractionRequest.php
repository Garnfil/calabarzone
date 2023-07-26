<?php

namespace App\Http\Requests\Attraction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttractionRequest extends FormRequest
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
            'featured_image' => 'image',
            'province_id' => 'required',
            'city_id' => 'required',
            'how_to_get_there' => 'required',
            'interest_type' => 'required',
            'description' => 'required',
            'things_todo' => 'required',
            'operational_hours' => 'required',
            'best_time_to_visit' => 'required',
            'contact_number' => 'nullable',
            'mobile_number' => 'nullable'
        ];
    }
}
