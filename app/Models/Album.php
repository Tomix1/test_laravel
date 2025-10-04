<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int                        $id
 * @property string                     $title
 * @property int                        $author_id
 * @property Carbon|null                $created_at
 * @property Carbon|null                $updated_at
 * @property-read Author                $author
 * @property-read Collection<int, Song> $songs
 * @property-read int|null              $songs_count
 * @method static Builder<static>|Album newModelQuery()
 * @method static Builder<static>|Album newQuery()
 * @method static Builder<static>|Album query()
 * @method static Builder<static>|Album whereAuthorId($value)
 * @method static Builder<static>|Album whereCreatedAt($value)
 * @method static Builder<static>|Album whereId($value)
 * @method static Builder<static>|Album whereTitle($value)
 * @method static Builder<static>|Album whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Album extends Model
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
