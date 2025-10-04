<?php

namespace App\Http\Api\Resources;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Author $resource
 */
class AuthorResource extends JsonResource
{
    public function __construct(Author $resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->resource->id,
            'name'            => $this->resource->name,
            'foundation_year' => $this->resource->foundation_year,
            'songs_count'     => $this->resource->songs_count ?? 0,
            'website'         => $this->resource->website,
        ];
    }
}
