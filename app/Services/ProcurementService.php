<?php

namespace App\Services;

use App\Dto\Parameters\OptimalProcurementParameters;
use App\Dto\Results\OptimalProcurementDto;
use Illuminate\Support\Collection;

class ProcurementService
{
    /**
     * @return Collection<OptimalProcurementDto>
     */
    public function calculateOptimal(OptimalProcurementParameters $parameters): Collection
    {
        $offers = $parameters->offers->sortBy('price');

        $result = collect();
        $need   = $parameters->need;

        foreach ($offers as $offer) {
            if ($need <= 0) {
                break;
            }

            $maxNeedFromOffer = min($offer->count, $need);

            $maxByPack = (int)(floor($maxNeedFromOffer / $offer->pack) * $offer->pack);

            if ($maxByPack > 0) {
                $result[] = new OptimalProcurementDto(
                    id:  $offer->id,
                    qty: $maxByPack,
                );

                $need -= $maxByPack;
            }
        }

        if ($need > 0) {
            return collect();
        }

        return $result->sortBy('id');
    }
}
