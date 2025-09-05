<?php
namespace Database\Seeders;

use App\Models\User; // Import the User model
use Carbon\Carbon;   // Import the Role model
use Illuminate\Database\Seeder;
// Import Hash for password hashing

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the users to be created
        $users = [
            [
                'full_name' => 'John Doe',
                'email'     => 'john.doe@example.com',
                'roles'     => [1, 2], // Assign roles by ID (e.g., Author and Editor)
            ],
            [
                'full_name' => 'Jane Smith',
                'email'     => 'jane.smith@example.com',
                'roles'     => [2, 3], // Assign roles by ID (e.g., Editor and Subscriber)
            ],
            [
                'full_name' => 'Alice Johnson',
                'email'     => 'alice.johnson@example.com',
                'roles'     => [1], // Assign role by ID (e.g., Author)
            ],
            [
                'full_name' => 'Bob Brown',
                'email'     => 'bob.brown@example.com',
                'roles'     => [4], // Assign role by ID (e.g., Administrator)
            ],
        ];

        // Insert the users into the users table
        foreach ($users as $user) {
            $newUser = User::create([
                'full_name'  => $user['full_name'],
                'email'      => $user['email'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Assign roles to the user with timestamps
            foreach ($user['roles'] as $roleId) {
                $newUser->roles()->attach($roleId, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
