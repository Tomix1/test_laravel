<?php

namespace App\Http\Api\Requests;

use App\Models\Album;
use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;

class SongListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'     => [
                'sometimes',
                'string',
            ],
            'author_id' => [
                'sometimes',
                'integer',
                'exists:' . Author::class . ',id',
            ],
            'album_id'  => [
                'sometimes',
                'integer',
                'exists:' . Album::class . ',id',
            ],
            'sort'      => [
                'sometimes',
                'string',
                'in:title,duration_in_seconds,genre_id',
            ],
            'page'      => [
                'sometimes',
                'integer',
                'min:1',
            ],
            'per_page'  => [
                'sometimes',
                'integer',
                'min:10',
                'max:25',
            ],
        ];
    }
}
