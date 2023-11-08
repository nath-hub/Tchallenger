<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParameterRequest extends FormRequest
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
            "color"=>"required|string",
            "notif_abonnement",
            "notif_challenge",
            "notif_comment",
            "notif_publication",
            "notif_message",
            "langue",
        ]; 
    }
}
