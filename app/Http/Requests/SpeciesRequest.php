<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpeciesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules =  [
            'scientific_name' => 'required|string',
            'name' => 'required|string',
            'origin' => 'required|string',
            'description' => 'required|string',
            'article' => 'required|string',
            'shed_id' => 'required|exists:sheds,id'
        ];

        if ($this->isMethod('POST') || $this->image)
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        return $rules;
    }
}
