<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface RoleRepositoryInterface
{
    public function getAllRoles(Request $request);
}
