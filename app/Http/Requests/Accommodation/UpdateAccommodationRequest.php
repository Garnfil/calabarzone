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
            'province_id' => 'required',
            'city_id' => 'required',
            'merchant_code' => 'nullable',
            'classification' => 'nullable',
            'description' => 'required',
            'interest_type' => 'required',
            'contact_number' => 'nullable',
            'contact_email' => 'nullable'
        ];
    }
}
