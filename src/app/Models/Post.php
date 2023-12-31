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
class Post extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'posts';

    protected $fillable = [
        'header',
        'text',
        'photo',
        'slug',
        'author'
    ];
    protected  $primaryKey = 'id';


}
