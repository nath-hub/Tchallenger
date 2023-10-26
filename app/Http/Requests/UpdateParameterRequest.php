<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParameterRequest extends FormRequest
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
            "color"=>"sometimes|required|string",
            "notif_abonnement"=>"sometimes|required",
            "notif_challenge"=>"sometimes|required",
            "notif_comment"=>"sometimes|required",
            "notif_publication"=>"sometimes|required",
            "notif_message"=>"sometimes|required",
            "langue"=>"sometimes|required",
        ];
    }
}
