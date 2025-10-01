<?php

namespace App\Dto\Parameters;

class OfferParameters
{
    public function __construct(
        public int $id,
        public int $count,
        public int $price,
        public int $pack,
    ){
    }
}
