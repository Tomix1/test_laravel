<?php

namespace App\Http\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreAuthorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'            => [
                'required',
                'string',
            ],
            'foundation_year' => [
                'required',
                'integer',
                'min:1700',
                'max:' . Carbon::now()->year,
            ],
            'website'         => [
                'sometimes',
                'url'
            ],
        ];
    }
}
