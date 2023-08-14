<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    /**
     * @param string $field
     * @param int|string|bool $value
     * @return $this
     */
    public function where(string $field, int|string|bool $value): self
    {
        $this->model = $this->model->where($field, $value);
        return $this;
    }


}
