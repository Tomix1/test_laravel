<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int                        $id
 * @property string                     $name
 * @property int                        $job_title_id
 * @property Carbon|null                $created_at
 * @property Carbon|null                $updated_at
 * @property-read JobTitle|null         $jobTitle
 * @property-read Collection<int, Trip> $trips
 * @method static Builder<static>|Employee newModelQuery()
 * @method static Builder<static>|Employee newQuery()
 * @method static Builder<static>|Employee query()
 * @method static Builder<static>|Employee whereCreatedAt($value)
 * @method static Builder<static>|Employee whereId($value)
 * @method static Builder<static>|Employee whereJobTitleId($value)
 * @method static Builder<static>|Employee whereName($value)
 * @method static Builder<static>|Employee whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Employee extends Model
{
    public function jobTitle(): HasOne
    {
        return $this->hasOne(JobTitle::class);
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
