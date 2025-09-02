<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int                   $id
 * @property int                   $car_model_id
 * @property string                $number
 * @property int                   $car_category_id
 * @property Carbon|null           $created_at
 * @property Carbon|null           $updated_at
 * @property-read CarCategory|null $carCategory
 * @property-read CarModel|null    $carModel
 * @property-read Driver|null      $driver
 * @property-read Trip|null        $trips
 * @method static Builder<static>|Car newModelQuery()
 * @method static Builder<static>|Car newQuery()
 * @method static Builder<static>|Car query()
 * @method static Builder<static>|Car whereCarModelId($value)
 * @method static Builder<static>|Car whereCarCategoryId($value)
 * @method static Builder<static>|Car whereCreatedAt($value)
 * @method static Builder<static>|Car whereId($value)
 * @method static Builder<static>|Car whereModel($value)
 * @method static Builder<static>|Car whereNumber($value)
 * @method static Builder<static>|Car whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Car extends Model
{
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function carCategory(): BelongsTo
    {
        return $this->belongsTo(CarCategory::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
