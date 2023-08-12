<?php

namespace App\Http\Requests\GCITour;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGCITourRequest extends FormRequest
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
            'province' => 'nullable',
            'what_to_wear' => 'nullable',
            'best_time' => 'nullable',
            'tour_duration' => 'nullable',
            'flyers' => 'mimes:pdf',
            'youtube' => 'nullable',
            'tour_type' => 'nullable',
            'tour_cities' => 'nullable|array|min:1', // Make sure tour_cities is an array and has at least one element
            'tour_cities.*.city' => 'nullable',
            'tour_cities.*.tour_details' => 'nullable',
            'tour_cities.*.background_image' => 'image',
            'tour_cover' => 'image'
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
