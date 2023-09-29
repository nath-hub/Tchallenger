<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "login"=>"required|string",
            "email"=>"required|unique:users|email",
            "phone"=>"required|integer|unique:users",
            "active"=>"boolean",
            "avatar"=>"string",
            "password"=>"string|required"
        ];
    }
}
