<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int                $id
 * @property int                $employee_id
 * @property int                $car_id
 * @property string             $started_at
 * @property string             $finished_at
 * @property Carbon|null        $created_at
 * @property Carbon|null        $updated_at
 * @property-read Car|null      $car
 * @property-read Employee|null $employee
 * @method static Builder<static>|Trip newModelQuery()
 * @method static Builder<static>|Trip newQuery()
 * @method static Builder<static>|Trip query()
 * @method static Builder<static>|Trip whereCarId($value)
 * @method static Builder<static>|Trip whereCreatedAt($value)
 * @method static Builder<static>|Trip whereEmployeeId($value)
 * @method static Builder<static>|Trip whereFinishedAt($value)
 * @method static Builder<static>|Trip whereId($value)
 * @method static Builder<static>|Trip whereStartedAt($value)
 * @method static Builder<static>|Trip whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Trip extends Model
{
    protected $casts = [
        'started_at'  => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
