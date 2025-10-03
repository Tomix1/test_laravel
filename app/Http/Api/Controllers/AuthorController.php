<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\AuthorListRequest;
use App\Http\Api\Requests\StoreAuthorRequest;
use App\Http\Api\Requests\UpdateAuthorRequest;
use App\Http\Api\Resources\AuthorResource;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Repositories\Parameters\FindAuthorParameters;
use App\Repositories\AuthorRepository;
use App\Repositories\Parameters\StoreAuthorParameters;
use App\Repositories\Parameters\UpdateAuthorParameters;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Throwable;

class AuthorController extends Controller
{
    public function index(AuthorListRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        $parameters = new FindAuthorParameters(
            name: $data['name'] ?? null,
            sort: $data['sort'] ?? null,
            page: $data['page'] ?? null,
            perPage: $data['perPage'] ?? null,
            withSongsCount: true
        );

        $repository = app(AuthorRepository::class);

        $authors = $repository->find($parameters);

        return AuthorResource::collection($authors);
    }

    public function show(Author $author): AuthorResource
    {
        $author->loadCount('songs');

        return new AuthorResource($author);
    }

    public function store(StoreAuthorRequest $request): AuthorResource
    {
        $data = $request->validated();

        $parameters = new StoreAuthorParameters(
            name: $data['name'],
            foundationYear: $data['foundation_year'],
            website: $data['website'] ?? null
        );

        $repository = app(AuthorRepository::class);

        try {
            $author = $repository->store($parameters);
        } catch (Throwable $exception) {
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

        return new AuthorResource($author);
    }

    public function update(UpdateAuthorRequest $request, Author $author): AuthorResource
    {
        $data = $request->validated();

        $parameters = new UpdateAuthorParameters(
            name: $data['name'] ?? null,
            foundationYear: $data['foundation_year'] ?? null,
            website: $data['website'] ?? null
        );

        $repository = app(AuthorRepository::class);

        try {
            $author = $repository->update($author, $parameters);
        } catch (Throwable $exception) {
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

        return new AuthorResource($author);
    }

    public function delete(Author $author): JsonResponse
    {
        $repository = app(AuthorRepository::class);

        try {
            $repository->delete($author);
        } catch (Throwable $exception) {
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }

        return response()->json(['message' => __('messages.deleted_successfully')]);
    }
}
