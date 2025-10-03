<?php

namespace App\Repositories;

use App\Models\Song;
use App\Repositories\Parameters\FindSongParameters;
use App\Repositories\Parameters\StoreSongParameters;
use App\Repositories\Parameters\UpdateSongParameters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class SongRepository
{
    public function find(FindSongParameters $parameters): LengthAwarePaginator
    {
        return Song::query()
            ->when($parameters->withGenre, fn(Builder $query) => $query->with('genre'))
            ->when($parameters->withAlbum, fn(Builder $query) => $query->with('album'))
            ->when($parameters->withAuthor, fn(Builder $query) => $query->with('author'))
            ->when($parameters->title, fn(Builder $query) => $query->where('title', 'like', "%$parameters->title%"))
            ->when($parameters->albumId, fn(Builder $query) => $query->where('album_id', $parameters->albumId))
            ->when($parameters->authorId, fn(Builder $query) => $query->where('author_id', $parameters->authorId))
            ->when($parameters->sort, fn (Builder $query) => $query->orderBy($parameters->sort))
            ->paginate(perPage: $parameters->perPage, page: $parameters->page);
    }

    /**
     * @throws Throwable
     */
    public function store(StoreSongParameters $parameters): Song
    {
        $song = new Song();

        $song->title               = $parameters->title;
        $song->duration_in_seconds = $parameters->durationInSeconds;
        $song->album_id            = $parameters->albumId;
        $song->author_id           = $parameters->authorId;
        $song->genre_id            = $parameters->genreId;

        $song->saveOrFail();

        return $song;
    }

    /**
     * @throws Throwable
     */
    public function update(Song $song, UpdateSongParameters $parameters): Song
    {
        if (!is_null($parameters->title)) {
            $song->title = $parameters->title;
        }

        if (!is_null($parameters->durationInSeconds)) {
            $song->duration_in_seconds = $parameters->durationInSeconds;
        }

        if (!is_null($parameters->albumId)) {
            $song->album_id = $parameters->albumId;
        }

        if (!is_null($parameters->authorId)) {
            $song->author_id = $parameters->authorId;
        }

        if (!is_null($parameters->genreId)) {
            $song->genre_id = $parameters->genreId;
        }

        $song->saveOrFail();

        return $song;
    }

    /**
     * @throws Throwable
     */
    public function delete(Song $song): void
    {
        $song->deleteOrFail();
    }
}
