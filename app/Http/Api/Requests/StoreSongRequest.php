<?php

namespace App\Http\Api\Requests;

use App\Models\Album;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;

class StoreSongRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'               => [
                'required',
                'string',
            ],
            'duration_in_seconds' => [
                'required',
                'integer',
                'min:1'
            ],
            'author_id'           => [
                'required',
                'integer',
                'exists:' . Author::class . ',id',
            ],
            'album_id'            => [
                'required',
                'integer',
                'exists:' . Album::class . ',id',
            ],
            'genre_id'            => [
                'required',
                'integer',
                'exists:' . Genre::class . ',id',
            ],
        ];
    }
}
