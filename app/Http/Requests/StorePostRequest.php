<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;

class StorePostRequest extends FormRequest
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
        $routerName = $this->route()->getName();

        if ($routerName === "posts.files") {

            return [
                'avatar_file' => [ 'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
                        'mov', 'avi', 'wmv', 'mp3', 'm4a',
                        'jpg', 'jpeg', 'mpga', 'webp', 'wma',
                    ],
                    'max_upload_time' => 5,
            ];
        }
        return [
            "title" => "string|required",
            "description" => "string|required",
            "start_date" => "date",
            "end_date" => "date",
            "type" => "string",
            "lieu" => "string",
            "price" => "integer",
            "private" => "string",
            "url_video" => "string",
            "url_audio" => "string",
            "url_image" => "string",
            "categorie_id" => "integer",
        ];
    }
}
