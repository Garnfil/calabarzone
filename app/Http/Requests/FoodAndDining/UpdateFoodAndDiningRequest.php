<?php

namespace App\Http\Requests\FoodAndDining;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodAndDiningRequest extends FormRequest
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
            'featured_image' => 'image',
            'merchant_code' => 'nullable',
            'business_name' => 'nullable',
            'interest_type' => 'nullable',
            'cuisine' => 'nullable',
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
