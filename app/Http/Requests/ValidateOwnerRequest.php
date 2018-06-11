<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateOwnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $nameUnique = Rule::unique('owners', 'name');

        $nameUnique = ($this->method() === 'PATCH')
            ? $nameUnique->ignore($this->route('owner')->id)
            : $nameUnique;

        return [
            'is_active' => 'boolean',
            'name'      => ['required', $nameUnique],
        ];
    }
}
