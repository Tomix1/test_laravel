<?php

namespace App\Dto\Parameters;

use App\Http\Api\V1\Requests\OptimalProcurementRequest;
use Illuminate\Support\Collection;

class OptimalProcurementParameters
{
    /**
     * @param Collection<OfferParameters> $offers
     */
    public function __construct(
        public int        $need,
        public Collection $offers,
    ) {
    }

    public static function fromRequest(OptimalProcurementRequest $request): static
    {
        $data = $request->validated();

        return new static(
            need:   $data['need'],
            offers: collect($data['offers'])->map(
                        static fn($offer) => new OfferParameters(
                            id:    $offer['id'],
                            count: $offer['count'],
                            price: $offer['price'],
                            pack:  $offer['pack'],
                        )
                    )
        );
    }
}
