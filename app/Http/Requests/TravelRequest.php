<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_public' => ['boolean','required'],
            'name' => ['required','string','max:255'],
            'description' => ['required','string','max:400'],
            'number_of_days' => ['required','numeric','gte:1']
        ];
    }
}
