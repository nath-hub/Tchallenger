<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipationRequest extends FormRequest
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
            "title" => "required|string",
            "description" => "required|string",
            "url_video" => "string",
            "url_audio" => "string",
            "url_image" => "string",
            "likes" => "string",
            "vues" => "string",
            "shares" => "string",
            "comments" => "string",
            "post_id" => "integer",
            "media_id"=> "integer",
        ];
    }
}
