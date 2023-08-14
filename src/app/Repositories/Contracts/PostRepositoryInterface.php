<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PostRepositoryInterface
{
    public function find(int $id): ?Model;

    public function whereSlug(string $slug): self;

    public function create(array $post): Model;

    public function updateById(int $id, array $newValuesPost): bool;

    public function deleteById(int $id): bool;

    public function exists(int $id): bool;

    public function doesntExist(int $id): bool;

    public function sortBy(string $field, string $direction): self;

    public function isExistOrderBy(array|null $orderby): bool;

    public function isExistPost(array|null $posts): bool;

    public function filter(array $posts): self;
}
