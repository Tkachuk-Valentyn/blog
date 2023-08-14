<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Services\Utils\Contracts\AuthServiceInterface;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIdAuthenticateUser
{
    public function __construct(readonly AuthServiceInterface $authService,
                                readonly CommentRepositoryInterface $commentRepository)
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $authUser = $this->authService->user();
        $idComment = $request->route('id_comment');
        $comment = $this->commentRepository->find($idComment);

        if ($comment['author'] == $authUser['id']) {
            return $next($request);
        }
        return response()->json(['error' => 'Forbidden'],403);
    }
}
