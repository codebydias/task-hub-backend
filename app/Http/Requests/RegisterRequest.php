<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6'
        ];
    }
}
