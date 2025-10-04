<?php

namespace App\Repositories\Parameters;

readonly class FindSongParameters
{
    public function __construct(
        public ?string $title,
        public ?int $authorId,
        public ?int $albumId,
        public ?string $sort,
        public ?int $page,
        public ?int $perPage,
        public bool $withGenre = false,
        public bool $withAlbum = false,
        public bool $withAuthor = false,
    ){
    }
}
