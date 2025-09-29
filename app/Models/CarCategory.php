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
 * @property int                            $id
 * @property string                         $title
 * @property Carbon|null                    $created_at
 * @property Carbon|null                    $updated_at
 * @property-read Collection<int, Car>      $cars
 * @property-read Collection<int, JobTitle> $jobTitles
 * @property-read int|null                  $job_titles_count
 * @method static Builder<static>|CarCategory newModelQuery()
 * @method static Builder<static>|CarCategory newQuery()
 * @method static Builder<static>|CarCategory query()
 * @method static Builder<static>|CarCategory whereCreatedAt($value)
 * @method static Builder<static>|CarCategory whereId($value)
 * @method static Builder<static>|CarCategory whereTitle($value)
 * @method static Builder<static>|CarCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class CarCategory extends Model
{
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function jobTitles(): BelongsToMany
    {
        return $this->belongsToMany(JobTitle::class);
    }
}
