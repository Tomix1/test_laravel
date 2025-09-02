<?php

namespace App\Http\Controllers;

use App\Dto\Parameters\AvailableCarParameters;
use App\Http\Requests\AvailableCarRequest;
use App\Http\Resources\AvailableCarResource;
use App\Services\CarService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CarController extends Controller
{
    public function available(AvailableCarRequest $request): AnonymousResourceCollection
    {
        $carService = app(CarService::class);

        $parameters = AvailableCarParameters::fromRequest($request);

        $cars = $carService->availableCars($parameters);

        return AvailableCarResource::collection($cars);
    }
}
