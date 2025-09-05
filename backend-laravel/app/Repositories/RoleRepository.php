<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Retrieve all roles from the database.
     *
     * @param Request $request The incoming request instance.
     * @return \Illuminate\Database\Eloquent\Collection|Role[] A collection of Role models.
     */
    public function getAllRoles(Request $request)
    {
        return Role::all();
    }
}
