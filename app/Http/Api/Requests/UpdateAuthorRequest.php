<?php

namespace App\Http\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UpdateAuthorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'            => [
                'sometimes',
                'string',
            ],
            'foundation_year' => [
                'sometimes',
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
