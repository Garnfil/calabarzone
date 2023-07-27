<?php

namespace App\Http\Requests\FoodAndDining;

use Illuminate\Foundation\Http\FormRequest;

class CreateFoodAndDiningRequest extends FormRequest
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
            'featured_image' => 'required|image',
            'merchant_code' => 'required',
            'business_name' => 'required',
            'interest_type' => 'required',
            'cuisine' => 'required',
            'price_range' => 'nullable',
            'operation_hours' => 'nullable',
            'atmosphere' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'trunkline' => 'nullable',
            'mobile_number' => 'nullable'
        ];
    }
}
