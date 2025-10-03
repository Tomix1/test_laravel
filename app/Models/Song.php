<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int         $id
 * @property string      $title
 * @property int         $duration_in_seconds
 * @property int         $album_id
 * @property int         $author_id
 * @property int         $genre_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Album  $album
 * @property-read Author $author
 * @property-read Genre  $genre
 * @method static Builder<static>|Song newModelQuery()
 * @method static Builder<static>|Song newQuery()
 * @method static Builder<static>|Song query()
 * @method static Builder<static>|Song whereAlbumId($value)
 * @method static Builder<static>|Song whereAuthorId($value)
 * @method static Builder<static>|Song whereCreatedAt($value)
 * @method static Builder<static>|Song whereDurationInSeconds($value)
 * @method static Builder<static>|Song whereGenreId($value)
 * @method static Builder<static>|Song whereId($value)
 * @method static Builder<static>|Song whereTitle($value)
 * @method static Builder<static>|Song whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Song extends Model
{
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
