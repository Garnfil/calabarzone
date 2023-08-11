<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;

class CreateProvinceRequest extends FormRequest
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
            'name' => 'required|max:20',
            'featured_image' => "nullable|image",
            'description' => 'nullable|max:1000',
            'tagline' => 'nullable',
            'delicacies' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }
}
