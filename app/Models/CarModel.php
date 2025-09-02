<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int                       $id
 * @property string                    $title
 * @property Carbon|null               $created_at
 * @property Carbon|null               $updated_at
 * @property-read Collection<int, Car> $cars
 * @method static Builder<static>|CarModel newModelQuery()
 * @method static Builder<static>|CarModel newQuery()
 * @method static Builder<static>|CarModel query()
 * @method static Builder<static>|CarModel whereCreatedAt($value)
 * @method static Builder<static>|CarModel whereId($value)
 * @method static Builder<static>|CarModel whereTitle($value)
 * @method static Builder<static>|CarModel whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CarModel extends Model
{
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
