<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private UserService $service
    ) {}

    public function index(Request $request)
    {
        $users = $this->service->paginate(
            $request->integer('per_page', 15)
        );

        return UserResource::collection($users);
    }

    public function show(int $id)
    {
        return new UserResource(
            $this->service->find($id)
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->service->create(
            $request->validated()
        );

        return new UserResource($user);
    }

    public function update(
        UpdateUserRequest $request,
        int $id
    ) {
        $user = $this->service->update(
            $id,
            $request->validated()
        );

        return new UserResource($user);
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
        ]);
    }
}