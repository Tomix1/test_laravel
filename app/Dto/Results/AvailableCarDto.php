<?php

namespace App\Dto\Results;

class AvailableCarDto
{
    public function __construct(
        public int    $id,
        public string $number,
        public int    $modelId,
        public string $model,
        public int    $categoryId,
        public string $category,
    ) {
    }
}
