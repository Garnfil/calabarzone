<?php

namespace App\Http\Requests\Interests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterestRequest extends FormRequest
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
            'interest_name' => 'required',
            'featured_image' => 'nullable|image',
            'icon' => 'nullable|image',
            'description' => 'nullable'
        ];
    }
}
