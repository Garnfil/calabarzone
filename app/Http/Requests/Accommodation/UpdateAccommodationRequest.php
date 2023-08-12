<?php

namespace App\Http\Requests\Accommodation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccommodationRequest extends FormRequest
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
            'business_name' => 'required',
            'featured_image' => 'image',
            'province_id' => 'nullable',
            'city_id' => 'nullable',
            'merchant_code' => 'nullable',
            'classification' => 'nullable',
            'description' => 'nullable',
            'interest_type' => 'nullable',
            'contact_number' => 'nullable',
            'contact_email' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'website' => 'nullable',
        ];
    }
}
