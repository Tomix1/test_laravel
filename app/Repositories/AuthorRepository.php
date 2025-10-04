<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Parameters\FindAuthorParameters;
use App\Repositories\Parameters\StoreAuthorParameters;
use App\Repositories\Parameters\UpdateAuthorParameters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class AuthorRepository
{
    public function find(FindAuthorParameters $parameters): LengthAwarePaginator
    {
        return Author::query()
            ->when($parameters->withSongsCount, fn(Builder $query) => $query->withCount('songs'))
            ->when($parameters->name, fn(Builder $query) => $query->where('name', 'like', "%$parameters->name%"))
            ->when($parameters->sort, fn (Builder $query) => $query->orderBy($parameters->sort))
            ->paginate(perPage: $parameters->perPage, page: $parameters->page);
    }

    /**
     * @throws Throwable
     */
    public function store(StoreAuthorParameters $parameters): Author
    {
        $author = new Author();

        $author->name            = $parameters->name;
        $author->foundation_year = $parameters->foundationYear;

        if (!is_null($parameters->website)) {
            $author->website = $parameters->website;
        }

        $author->saveOrFail();

        return $author;
    }

    /**
     * @throws Throwable
     */
    public function update(Author $author, UpdateAuthorParameters $parameters): Author
    {
        if (!is_null($parameters->name)) {
            $author->name = $parameters->name;
        }

        if (!is_null($parameters->foundationYear)) {
            $author->foundation_year = $parameters->foundationYear;
        }

        if (!is_null($parameters->website)) {
            $author->website = $parameters->website;
        }

        $author->saveOrFail();

        return $author;
    }

    /**
     * @throws Throwable
     */
    public function delete(Author $author): void
    {
        $author->deleteOrFail();
    }
}
