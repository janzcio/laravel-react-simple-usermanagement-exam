<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new UserController instance.
     *
     * @param UserService $userService The service responsible for user management.
     */
    public function __construct(private readonly UserService $userService)
    {
    }

    /**
     * Store a newly created user in the database.
     *
     * @param StoreUserRequest $request The validated request containing user data.
     * @return \Illuminate\Http\JsonResponse The response containing the created user.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        return success('User created successfully', $user, 201);
    }

    /**
     * Retrieve users grouped by their roles.
     *
     * @param Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse The response containing the grouped users.
     */
    public function getUserByRole(Request $request)
    {
        $groupedUsers = $this->userService->getUsersByRole($request);

        return success('Users retrieved successfully', $groupedUsers);
    }
}
