<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Create a new UserService instance.
     *
     * @param UserRepository $userRepository The repository responsible for user data access.
     */
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * Create a new user.
     *
     * @param array $data The data for the new user, including full name, email, and roles.
     * @return \App\Models\User The created user instance.
     */
    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * Retrieve users grouped by their roles.
     *
     * @param Request $request The incoming request instance, which may contain filters.
     * @return array The users grouped by their roles.
     */
    public function getUsersByRole(Request $request)
    {
        return $this->userRepository->getAllUsersWithRoles($request);
    }
}
