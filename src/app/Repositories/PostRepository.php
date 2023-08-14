<?php

namespace App\Repositories;


use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @param string $slug
     * @return $this
     */
    public function whereSlug(string $slug): self
    {
        $this->model = $this->model->where('slug', $slug);
        return $this;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function doesntExist(int $id): bool
    {
        return !$this->exists($id);
    }

    /**
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function sortBy(string $field, string $direction): self
    {
        $this->model = $this->model->orderBy($field, $direction);
        return $this;
    }

    /**
     * @param array|null $orderby
     * @return bool
     */
    public function isExistOrderBy(array|null $orderby): bool
    {
        return $orderby != null && array_key_exists('field', $orderby) && ($orderby['field']) != null && array_key_exists('direction', $orderby);
    }

    /**
     * @param array|null $posts
     * @return bool
     */
    public function isExistPost(array|null $posts): bool
    {
        return $posts != null && (array_key_exists('header', $posts) || array_key_exists('text', $posts));
    }

    /**
     * @param array $posts
     * @return $this
     */
    public function filter(array $posts): self
    {
        $this->model = $this->model->where($posts);
        return $this;
    }
}
