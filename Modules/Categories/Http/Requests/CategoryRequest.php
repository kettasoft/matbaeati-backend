<?php

namespace Modules\Categories\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return RuleFactory::make([
            '%name%' => ['required', 'string', 'max:255'],
            '%description%' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'active' => ['nullable', 'boolean'],
            // 'image' => ['nullable', 'mimes:jpeg,jpg,png', 'max:1000'],
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
