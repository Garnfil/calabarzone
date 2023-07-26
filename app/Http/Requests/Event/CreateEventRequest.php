<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'event_name' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'featured_image' => 'required|image',
            'interest_type' => 'required',
            'event_date' => 'required',
            'description' => 'required',
            'what_to_wear' => 'required',
            'travel_tips' => 'nullable',
            'contact_person' => 'nullable',
            'contact_number' => 'nullable'
        ];
    }
}
