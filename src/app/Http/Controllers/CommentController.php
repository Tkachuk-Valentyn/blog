<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function __construct(readonly CommentRepositoryInterface $commentRepository)
    {

    }

    /**
     * @param int $idPost
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function store(int $idPost, StoreCommentRequest $request): JsonResponse
    {
        $validatedComment = $request->validated();
        $validatedComment['id_post'] = $idPost;
        $author = $request->user();
        $validatedComment['author'] = $author['id'];
        return response()->json($this->commentRepository->create($validatedComment));
    }

    /**
     * @param int $idPost
     * @param Request $request
     * @return JsonResponse
     */
    public function index(int $idPost, Request $request): JsonResponse
    {
        return response()->json(CommentResource::collection($this->commentRepository->where('id_post', $idPost)->paginate($request->query('page'))));
    }

    /**
     * @param int $idPost
     * @param int $id
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function update(int $idPost, int $id, StoreCommentRequest $request)
    {

        if ($this->commentRepository->doesntExist($id)) {
            return response()->json(['error' => 'Page not Found'], 404);
        }
            $this->commentRepository->updateById($id, $request->validated());
            return response()->json($this->commentRepository->find($id));



    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $idPost, int $id): JsonResponse
    {
            $this->commentRepository->deleteById($id);
            return response()->json([], 204);
    }
}
