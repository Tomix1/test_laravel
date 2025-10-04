<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\StoreSongRequest;
use App\Http\Api\Requests\UpdateSongRequest;
use App\Http\Api\Resources\SongResource;
use App\Http\Controllers\Controller;
use App\Http\Api\Requests\SongListRequest;
use App\Models\Song;
use App\Repositories\Parameters\FindSongParameters;
use App\Repositories\Parameters\StoreSongParameters;
use App\Repositories\Parameters\UpdateSongParameters;
use App\Repositories\SongRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Throwable;

class SongController extends Controller
{
    public function index(SongListRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $parameters = new FindSongParameters(
            title: $data['title'] ?? null,
            authorId: $data['author_id'] ?? null,
            albumId: $data['album_id'] ?? null,
            sort: $data['sort'] ?? null,
            page: $data['page'] ?? 1,
            perPage: $data['per_page'] ?? 10,
            withGenre: true
        );

        $repository = app(SongRepository::class);

        $songs = $repository->find($parameters);

        return SongResource::collection($songs);
    }

    public function show(Song $song): SongResource
    {
        $song->load('genre');

        return new SongResource($song);
    }

    public function store(StoreSongRequest $request): SongResource
    {
        $data = $request->validated();

        $parameters = new StoreSongParameters(
            title: $data['title'],
            durationInSeconds: $data['duration_in_seconds'],
            authorId: $data['author_id'],
            albumId: $data['album_id'],
            genreId: $data['genre_id']
        );

        $repository = app(SongRepository::class);

        try {
            $song = $repository->store($parameters);
        } catch (Throwable $exception) {
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

        return new SongResource($song);
    }

    public function update(UpdateSongRequest $request, Song $song): SongResource
    {
        $data = $request->validated();

        $parameters = new UpdateSongParameters(
            title: $data['title'] ?? null,
            durationInSeconds: $data['duration_in_seconds'] ?? null,
            authorId: $data['author_id'] ?? null,
            albumId: $data['album_id'] ?? null,
            genreId: $data['genre_id'] ?? null
        );

        $repository = app(SongRepository::class);

        try {
            $song = $repository->update(
                song: $song,
                parameters: $parameters
            );
        } catch (Throwable $exception) {
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

        return new SongResource($song);
    }

    public function delete(Song $song): JsonResponse
    {
        $repository = app(SongRepository::class);

        try {
            $repository->delete($song);
        } catch (Throwable $exception) {
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

        return response()->json(['message' => __('messages.deleted_successfully')]);
    }
}
