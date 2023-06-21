<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourIndexDataRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'priceFrom' => ['numeric','nullable'],
            'priceTo' => ['numeric','nullable'],
            'dateFrom' => ['date','nullable'],
            'dateTo' => ['date','nullable'],
            'sortBy' => Rule::in(['price']),
            'sortOrder' => Rule::in(['asc','desc']),
        ];
    }

    public function messages()
    {
        return [
            'sortBy' => "the 'sortBy' parameter accepts only 'price' value",
            'sortOrder' => "the 'sortOrder' parameter accepts only 'asc' and 'desc value",
        ];
    }
}
