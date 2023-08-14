<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\CommentRepository;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\IPostServiceInterface;
use App\Services\PostService;
use App\Services\Tasks\Contracts\TaskServiceInterface;
use App\Services\Tasks\TaskService;
use App\Services\Utils\AuthService;
use App\Services\Utils\Contracts\AuthServiceInterface;
use App\Services\Utils\Contracts\StrServiceInterface;
use App\Services\Utils\StrService;
use Illuminate\Support\ServiceProvider;

/**
 * @method bind(string $class, \Closure $param)
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(IPostServiceInterface::class, function () {
            return new PostService(app(StrServiceInterface::class));
        });

        $this->app->bind(StrServiceInterface::class, function () {

            return new StrService();
        });

        $this->app->bind(TaskServiceInterface::class, function () {

            return new TaskService();
        });

        $this->app->bind(PostRepositoryInterface::class, function () {
            return new PostRepository(new Post());
        });

        $this->app->bind(CommentRepositoryInterface::class, function () {
            return new CommentRepository(new Comment());
        });

        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserRepository(new User());
        });

        $this->app->bind(AuthServiceInterface::class, function () {

            return new AuthService();
        });
    }
}
