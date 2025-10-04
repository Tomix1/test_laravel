<?php

namespace App\Http\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => [
                'sometimes',
                'string',
            ],
            'sort'     => [
                'sometimes',
                'string',
                'in:songs_count,foundation_year',
            ],
            'page'     => [
                'sometimes',
                'integer',
                'min:1',
            ],
            'per_page' => [
                'sometimes',
                'integer',
                'min:10',
                'max:25',
            ],
        ];
    }
}
