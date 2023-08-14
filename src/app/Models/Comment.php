<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $array)
 * @method static findOrFail()
 * @method static whereId($id)
 * @method static find($id)
 */
class Comment extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'comments';

    protected $fillable = [
        'author',
        'description',
        'id_post'
    ];
    protected  $primaryKey = 'id';


}
