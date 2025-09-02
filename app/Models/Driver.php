<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int           $id
 * @property string        $name
 * @property int|null      $car_id
 * @property Carbon|null   $created_at
 * @property Carbon|null   $updated_at
 * @property-read Car|null $car
 * @method static Builder<static>|Driver newModelQuery()
 * @method static Builder<static>|Driver newQuery()
 * @method static Builder<static>|Driver query()
 * @method static Builder<static>|Driver whereCarId($value)
 * @method static Builder<static>|Driver whereCreatedAt($value)
 * @method static Builder<static>|Driver whereId($value)
 * @method static Builder<static>|Driver whereName($value)
 * @method static Builder<static>|Driver whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Driver extends Model
{
    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }
}
