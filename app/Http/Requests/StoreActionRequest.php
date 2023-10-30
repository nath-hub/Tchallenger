<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionRequest extends FormRequest
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
        return [
            "type"=> "required|string",
            "ip_adress"=> "string",
            "canal"=> "sometimes|required_if:type, SHARE",
            "comments"=> "sometimes|required_if:type, COMMENTAIRE",
            "participation_id"=> "integer",
        ];
    }
}
