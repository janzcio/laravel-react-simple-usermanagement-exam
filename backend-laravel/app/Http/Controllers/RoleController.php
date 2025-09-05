<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;

class RoleController extends Controller
{
    /**
     * Create a new RoleController instance.
     *
     * @param RoleService $roleService The service responsible for role management.
     */
    public function __construct(private readonly RoleService $roleService)
    {
    }

    /**
     * Retrieve a list of roles.
     *
     * @param Request $request The incoming request instance.
     * @return \Illuminate\Http\JsonResponse The response containing the roles.
     */
    public function getRoles(Request $request)
    {
        $roles = $this->roleService->getRoles($request);

        return success('Roles retrieved successfully', $roles);
    }
}
