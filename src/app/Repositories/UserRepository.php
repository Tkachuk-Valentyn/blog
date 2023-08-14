<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param array $post
     * @return Model
     */
    public function create(array $post): Model
    {
        return $this->model->create([
            'name' => $post['name'],
            'email' => $post['email'],
            'password' => Hash::make($post['password'])
        ]);

    }

    /**
     * @param string $email
     * @return Model
     */
    public function where(string $email): Model
    {
        return $this->model->where('email', $email)->first();
    }
}
