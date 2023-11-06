<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
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
            'video' => 'sometimes|required|file|mimetypes:video/mp4, video/mpeg, video/x-matroska',
            'image'=> 'sometimes|required|image',
             'audio'=> 'sometimes|required|mimes:mp3,pcm_s16le,aiff,xm, mpeg',   
             'texte'=> 'sometimes|required|string|between:10,5000',
        ];
    }
}
