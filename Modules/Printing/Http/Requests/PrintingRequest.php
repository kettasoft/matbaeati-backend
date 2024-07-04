<?php

namespace Modules\Printing\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'count' => ['required', 'integer', 'min:1000'],
            'colors' => ['required', 'integer', 'min:1'],
            'width' => ['required','integer', 'min:50'],
            'height' => ['required','integer', 'min:50'],
            'thickness' => ['required', 'integer', 'max:400'],
            'quality' => ['required', 'integer', 'between:1,5'],
            'price' => ['nullable', 'integer'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
