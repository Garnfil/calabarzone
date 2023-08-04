<?php

namespace App\Http\Requests\GCITour;

use Illuminate\Foundation\Http\FormRequest;

class CreateGCITourRequest extends FormRequest
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
            'tour_name' => 'required',
            'province' => 'required',
            'what_to_wear' => 'nullable',
            'best_time' => 'nullable',
            'operation_hours' => 'nullable',
            'youtube_link' => 'nullable',
            'tour_cities' => 'required|array|min:1', // Make sure tour_cities is an array and has at least one element
            'tour_cities.*.city' => 'required',
            'tour_cities.*.description' => 'required',
            'tour_cities.*.background_image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tour_cities.required' => 'At least one city must be provided.',
            // Add more custom messages as needed for other fields
        ];
    }
}
