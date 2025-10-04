<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int                        $id
 * @property string                     $title
 * @property Carbon|null                $created_at
 * @property Carbon|null                $updated_at
 * @property-read Collection<int, Song> $songs
 * @property-read int|null              $songs_count
 * @method static Builder<static>|Genre newModelQuery()
 * @method static Builder<static>|Genre newQuery()
 * @method static Builder<static>|Genre query()
 * @method static Builder<static>|Genre whereCreatedAt($value)
 * @method static Builder<static>|Genre whereId($value)
 * @method static Builder<static>|Genre whereTitle($value)
 * @method static Builder<static>|Genre whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Genre extends Model
{
    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
