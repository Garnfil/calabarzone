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
            'province_id' => 'required',
            'city_id' => 'required',
            'activity_name' => 'required',
            'featured_image' => 'required|image',
            'interest_type' => 'required',
            'description' => 'required',
            'things_todo' => 'required',
            'what_to_wear' => 'required',
            'operational_hours' => 'required',
            'best_time_to_visit' => 'required'
        ];
    }
}
