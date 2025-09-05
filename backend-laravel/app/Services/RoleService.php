<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;

class RoleService
{
    public function __construct(private readonly RoleRepository $roleRepository)
    {
    }

    public function getRoles(Request $request)
    {
        return $this->roleRepository->getAllRoles($request);
    }
}
