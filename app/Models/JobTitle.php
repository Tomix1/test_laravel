<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int                               $id
 * @property string                            $title
 * @property Carbon|null                       $created_at
 * @property Carbon|null                       $updated_at
 * @property-read Collection<int, CarCategory> $carCategories
 * @property-read int|null                     $car_categories_count
 * @property-read Collection<int, Employee>    $employees
 * @method static Builder<static>|JobTitle newModelQuery()
 * @method static Builder<static>|JobTitle newQuery()
 * @method static Builder<static>|JobTitle query()
 * @method static Builder<static>|JobTitle whereCreatedAt($value)
 * @method static Builder<static>|JobTitle whereId($value)
 * @method static Builder<static>|JobTitle whereTitle($value)
 * @method static Builder<static>|JobTitle whereUpdatedAt($value)
 * @mixin Eloquent
 */
class JobTitle extends Model
{
    public function carCategories(): BelongsToMany
    {
        return $this->belongsToMany(CarCategory::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
