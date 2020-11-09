<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetMeals extends FormRequest
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
            'perPage' => 'bail|nullable|numeric',
            'page' => 'bail|nullable|numeric',
            'category' => 'bail|nullable|numeric',
            'tags' => 'bail|nullable|array',
            'with' => 'bail|nullable|array',
            'lang' => 'bail|required|max:2|exists:languages,locale',
            'diff_time' => 'bail|nullable'
        ];
        
    }
}
