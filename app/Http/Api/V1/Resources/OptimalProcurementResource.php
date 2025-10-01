<?php

namespace App\Http\Api\V1\Resources;

use App\Dto\Results\OptimalProcurementDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptimalProcurementResource extends JsonResource
{
    public function __construct(OptimalProcurementDto $dto)
    {
        parent::__construct($dto);
    }

    public function toArray(Request $request): array
    {
        /** @var OptimalProcurementDto $dto */
        $dto = $this->resource;

        return [
            'id'  => $dto->id,
            'qty' => $dto->qty,
        ];
    }
}
