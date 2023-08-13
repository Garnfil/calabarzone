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
            'tour_details' => 'nullable|max:1000',
            'province' => 'nullable',
            'what_to_wear' => 'nullable',
            'best_time' => 'nullable',
            'operation_hours' => 'nullable',
            'flyers' => 'mimes:pdf',
            'youtube' => 'nullable',
            'tour_cover' => 'nullable',
            'tour_type' => 'nullable',
            'tour_cities' => 'nullable|array|min:1', // Make sure tour_cities is an array and has at least one element
            'tour_cities.*.city' => 'nullable',
            'tour_cities.*.description' => 'nullable|max:1000',
            'tour_cities.*.background_image' => 'nullable',
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
