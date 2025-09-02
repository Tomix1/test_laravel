<?php

namespace App\Http\Resources;

use App\Dto\Results\AvailableCarDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvailableCarResource extends JsonResource
{
    public function __construct(AvailableCarDto $dto)
    {
        parent::__construct($dto);
    }

    public function toArray(Request $request): array
    {
        /** @var AvailableCarDto $dto */
        $dto = $this->resource;

        return [
            'id'          => $dto->id,
            'number'      => $dto->number,
            'model_id'    => $dto->modelId,
            'model'       => $dto->model,
            'category_id' => $dto->categoryId,
            'category'    => $dto->category,
        ];
    }
}
