<?php

namespace App\Services;

use App\Dto\Parameters\AvailableCarParameters;
use App\Dto\Results\AvailableCarDto;
use App\Models\Car;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CarService
{
    /**
     * @return Collection<AvailableCarDto>
     */
    public function availableCars(AvailableCarParameters $parameters): Collection
    {
        return Car::query()
                  ->with(['carModel', 'carCategory'])
                  ->when(!is_null($parameters->modelId),
                      static fn(Builder $query) => $query->where('car_model_id', $parameters->modelId)
                  )
                  ->when(!is_null($parameters->jobTitleId),
                      static function (Builder $query) use ($parameters) {
                          $query->whereIn('car_category_id', static function ($query) use ($parameters) {
                              $query->select('car_category_id')
                                    ->from('job_title_car_category')
                                    ->where('job_title_id', $parameters->jobTitleId)
                                    ->exists();
                          });
                      }
                  )
                  ->whereDoesntHave('trips', static function (Builder $query) use ($parameters) {
                      $query->whereBetween('started_at', [$parameters->startedAt, $parameters->finishedAt])
                            ->orWhereBetween('finished_at', [$parameters->startedAt, $parameters->finishedAt])
                            ->orWhere(static function (Builder $query) use ($parameters) {
                                $query->where('finished_at', '>=', $parameters->finishedAt)
                                      ->where('started_at', '<=', $parameters->startedAt);
                            });
                  })
                  ->get()
                  ->map(static function (Car $car) {
                      return new AvailableCarDto(
                          id:         $car->id,
                          number:     $car->number,
                          modelId:    $car->carModel->id,
                          model:      $car->carModel->title,
                          categoryId: $car->carCategory->id,
                          category:   $car->carCategory->title,
                      );
                  });
    }
}
