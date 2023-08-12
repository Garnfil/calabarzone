<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class CreateActivityRequest extends FormRequest
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
            'province_id' => 'nullable',
            'city_id' => 'nullable',
            'activity_name' => 'required',
            'featured_image' => 'nullable|image',
            'interest_type' => 'nullable',
            'description' => 'nullable',
            'things_todo' => 'nullable',
            'destination' => 'nullable',
            'what_to_wear' => 'nullable',
            'operational_hours' => 'nullable',
            'best_time_to_visit' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable'
        ];
    }
}
