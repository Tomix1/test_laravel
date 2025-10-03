<?php

namespace App\Http\Api\Resources;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Song $resource
 */
class SongResource extends JsonResource
{
    public function __construct(Song $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->resource->id,
            'title'               => $this->resource->title,
            'duration_in_seconds' => $this->resource->duration_in_seconds,
            'genre_id'            => $this->resource->genre_id,
            'genre'               => $this->resource->genre->title,
            'author_id'           => $this->resource->author_id,
            'album_id'            => $this->resource->album_id,
        ];
    }
}
