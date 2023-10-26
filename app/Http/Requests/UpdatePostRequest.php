<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            "title"=>"string|required|sometimes",
            "description"=>"string|required|sometimes",
            "start_date"=>"date|sometimes",
            "end_date"=>"date|sometimes",
            "lieu"=>"string|sometimes",
            "price"=>"integer|sometimes",
            "private"=>"string|sometimes",
            "url_video"=>"string|sometimes",
            "url_audio"=>"string|sometimes",
            "url_image"=>"string|sometimes",
        ];
    }
}
