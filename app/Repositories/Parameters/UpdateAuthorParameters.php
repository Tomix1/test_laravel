<?php

namespace App\Repositories\Parameters;

readonly class UpdateAuthorParameters
{
    public function __construct(
        public ?string $name,
        public ?int $foundationYear,
        public ?string $website
    ){
    }
}
