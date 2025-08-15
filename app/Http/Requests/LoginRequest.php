<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'    => 'required|email',
            'senha' => 'required|string|min:6'
        ];
    }
}
