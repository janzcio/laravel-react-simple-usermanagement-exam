<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function getAllUsersWithRoles(Request $request);
}
