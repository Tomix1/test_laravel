<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int                         $id
 * @property string                      $name
 * @property int                         $foundation_year
 * @property string|null                 $website
 * @property Carbon|null                 $created_at
 * @property Carbon|null                 $updated_at
 * @property-read Collection<int, Album> $albums
 * @property-read int|null               $albums_count
 * @property-read Collection<int, Song>  $songs
 * @property-read int|null               $songs_count
 * @method static Builder<static>|Author newModelQuery()
 * @method static Builder<static>|Author newQuery()
 * @method static Builder<static>|Author query()
 * @method static Builder<static>|Author whereCreatedAt($value)
 * @method static Builder<static>|Author whereFoundationYear($value)
 * @method static Builder<static>|Author whereId($value)
 * @method static Builder<static>|Author whereName($value)
 * @method static Builder<static>|Author whereUpdatedAt($value)
 * @method static Builder<static>|Author whereWebsite($value)
 * @mixin Eloquent
 */
class Author extends Model
{
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
