<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new user and assign roles with timestamps.
     *
     * @param array $data The data for the new user, including full name, email, and roles.
     * @return User The created user instance.
     */
    public function create(array $data): User
    {
        // Create the user
        $user = User::create([
            'full_name' => $data['full_name'],
            'email'     => $data['email'],
        ]);

        // Attach roles to the user without duplicating and add timestamps
        if (isset($data['roles'])) {
            // Prepare roles with timestamps
            $currentTimestamp = Carbon::now(); // Get the current timestamp using Carbon

            // Use array_map to create an array of roles with timestamps
            $rolesWithTimestamps = array_map(function ($roleId) use ($currentTimestamp) {
                return [
                    'role_id'    => $roleId,
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                ];
            }, $data['roles']);

            // Use syncWithoutDetaching to avoid duplicating roles
            $user->roles()->syncWithoutDetaching($rolesWithTimestamps);
        }

        return $user;
    }

    /**
     * Retrieve all users with their roles, optionally grouped by role.
     *
     * @param Request $request The incoming request instance, which may contain filters.
     * @return array|User[] The users grouped by their roles or a list of users.
     */
    public function getAllUsersWithRoles(Request $request)
    {
        $roleId = $request->query('role_id') ?? null;
        $groupedByRole = $request->query('groupbyrole', false);

        if ($groupedByRole) {
            $roles = Role::with('users:id,full_name,email')->get(); // Eager load users

            // Initialize an array to hold the grouped users
            $groupedUsers = [];

            foreach ($roles as $role) {
                // If a roleId is provided, only include users for that specific role
                if ($roleId && $role->id == $roleId) {
                    $groupedUsers[$role->name] = $role->users->map(function ($user) {
                        return [
                            'id'        => $user->id,
                            'full_name' => $user->full_name,
                            'email'     => $user->email,
                        ];
                    })->toArray();
                } elseif (!$roleId) {
                    // If no roleId is provided, include all users for each role
                    $groupedUsers[$role->name] = $role->users->map(function ($user) {
                        return [
                            'id'        => $user->id,
                            'full_name' => $user->full_name,
                            'email'     => $user->email,
                        ];
                    })->toArray();
                }
            }

            return $groupedUsers;
        } else {
            return User::with('roles:id,name') // Eager load roles
                ->when($roleId, function ($query) use ($roleId) {
                    // Filter users who have the specified role
                    $query->whereHas('roles', function ($subQuery) use ($roleId) {
                        $subQuery->where('roles.id', $roleId);
                    });
                })
                ->get();
        }
    }
}
