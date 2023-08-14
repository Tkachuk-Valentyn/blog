<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\Contracts\IPostServiceInterface;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

use Illuminate\Http\JsonResponse;

class PostsController extends Controller
{
    /**
     * @param PostRepositoryInterface $postRepository
     * @param IPostServiceInterface $postService
     */
        public function __construct(readonly PostRepositoryInterface $postRepository,
                                    readonly IPostServiceInterface   $postService)
        {

        }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->postRepository->all());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if ($this->postRepository->doesntExist($id)) {
            return response()->json(['error' => 'Page not Found'], 404);
        }
        return response()->json($this->postRepository->find($id));

    }

    public function showBySlug(string $slug): JsonResponse
    {
//        if ($this->postRepository->doesntExist($slug)) {
//            return response()->json(['error' => 'Page not Found'], 404);
//        }
        return response()->json($this->postRepository->whereSlug($slug)->get());
    }

    /**
     * @param Request $request
     * @return PostResource
     */
    public function showPage(Request $request): JsonResponse
    {
        return response()->json(PostResource::collection($this->postRepository->paginate($request->query('page'))));
    }

    /**
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $validatedPost = $request->validated();
        $validatedPost['slug'] = $this->postService->createSlug($validatedPost['header']);
        return response()->json($this->postRepository->create($validatedPost));

    }

    /**
     * @param int $id
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function update(int $id, StorePostRequest $request): JsonResponse
    {
        if ($this->postRepository->doesntExist($id)) {
            return response()->json(['error' => 'Page not Found'], 404);
        }
        $this->postRepository->updateById($id, $request->validated());
        return response()->json($this->postRepository->find($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->postRepository->deleteById($id);
        return response()->json([], 204);
    }
}
