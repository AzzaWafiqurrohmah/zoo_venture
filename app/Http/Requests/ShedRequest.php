<?php

namespace App\Http\Requests;

use App\Exceptions\Api\FailedValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ShedRequest extends FormRequest
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
            'name' => 'required',
            'coordinates' => 'required|array|min: 1',
            'color' => 'required'
        ];

        // dd($this->all());

        if($this->getMethod() == 'POST')
            $rules['name'] = 'required|unique:sheds,name';

        return $rules;
    }
}
