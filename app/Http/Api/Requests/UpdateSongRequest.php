<?php

namespace App\Http\Api\Requests;

use App\Models\Album;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSongRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'               => [
                'sometimes',
                'string',
            ],
            'duration_in_seconds' => [
                'sometimes',
                'integer',
                'min:1'
            ],
            'author_id'           => [
                'sometimes',
                'integer',
                'exists:' . Author::class . ',id',
            ],
            'album_id'            => [
                'sometimes',
                'integer',
                'exists:' . Album::class . ',id',
            ],
            'genre_id'            => [
                'sometimes',
                'integer',
                'exists:' . Genre::class . ',id',
            ],
        ];
    }
}
