<?php

namespace Modules\Advertisements\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => [ 'required', 'string', 'min:3', 'max:30' ],
            'description' => [ 'nullable', 'string', 'max:10000' ],
            'target' => [ 'required' ],
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
