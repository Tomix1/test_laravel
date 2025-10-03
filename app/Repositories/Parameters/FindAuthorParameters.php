<?php

namespace App\Repositories\Parameters;

readonly class FindAuthorParameters
{
    public function __construct(
        public ?string $name,
        public ?string $sort,
        public ?int $page,
        public ?int $perPage,
        public bool $withSongsCount = false,
    ){
    }
}
