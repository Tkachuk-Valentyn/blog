<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function create(array $post): Model;

}
