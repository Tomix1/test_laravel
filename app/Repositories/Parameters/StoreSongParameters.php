<?php

namespace App\Repositories\Parameters;

readonly class StoreSongParameters
{
    public function __construct(
        public string $title,
        public int $durationInSeconds,
        public int $authorId,
        public int $albumId,
        public int $genreId,
    ){
    }
}
