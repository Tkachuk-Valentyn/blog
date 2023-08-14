<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Utils\Contracts\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(readonly UserRepositoryInterface $userRepository,
                                readonly AuthServiceInterface $authService)
    {

    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->userRepository->all());
    }

    /**
     * @param Request $request
     * @return array
     */
    public function register(StoreUserRequest $request): JsonResponse
    {
        $this->userRepository->create($request->validated());
        $user = $this->userRepository->where($request['email']);
        return response()->json(['token' => $user->createToken("API TOKEN")->plainTextToken]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $validatedUser = $request->validated();
        if ($this->authService->attempt($validatedUser['email'], $validatedUser['password'])) {
            $user = $this->userRepository->where($request->email);
            return response()->json(['token' => $user->createToken("API TOKEN")->plainTextToken]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }


}
