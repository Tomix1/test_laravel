<?php

namespace App\Repositories\Parameters;

readonly class StoreAuthorParameters
{
    public function __construct(
        public string $name,
        public int $foundationYear,
        public ?string $website
    ){
    }
}
