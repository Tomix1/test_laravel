<?php

namespace App\Http\Api\V1\Controllers;

use App\Dto\Parameters\OptimalProcurementParameters;
use App\Http\Api\V1\Requests\OptimalProcurementRequest;
use App\Http\Api\V1\Resources\OptimalProcurementResource;
use App\Http\Controllers\Controller;
use App\Services\ProcurementService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProcurementController extends Controller
{
    public function optimal(OptimalProcurementRequest $request): AnonymousResourceCollection
    {
        $procurementService = app(ProcurementService::class);

        $parameters = OptimalProcurementParameters::fromRequest($request);

        $optimalProcurement = $procurementService->calculateOptimal($parameters);

        return OptimalProcurementResource::collection($optimalProcurement);
    }
}
