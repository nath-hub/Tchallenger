<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $routeName = $this->route()->getName();

        if ($routeName === 'send.email') {
            return [
                "email" => "required|email",
            ];
        } else {
            return [
                "login" => "sometimes|string|required|unique:users",
                "active" => "sometimes|boolean",
                "avatar" => "sometimes|string",
                "derniereConnexion" => "sometimes|string|required"
            ];
        }
    }
}
