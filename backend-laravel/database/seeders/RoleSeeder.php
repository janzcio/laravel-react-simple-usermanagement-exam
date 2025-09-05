<?php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the roles to be created
        $roles = [
            ['name' => 'Author'],
            ['name' => 'Editor'],
            ['name' => 'Subscriber'],
            ['name' => 'Administrator'],
        ];

        // Insert the roles into the roles table
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
