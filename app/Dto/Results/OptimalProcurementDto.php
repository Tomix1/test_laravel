<?php

namespace App\Dto\Results;

class OptimalProcurementDto
{
    public function __construct(
        public int $id,
        public int $qty,
    ) {
    }
}
