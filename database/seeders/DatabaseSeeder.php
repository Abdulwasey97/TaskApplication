<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create roles if not exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create permissions if not exists
        $editPermission = Permission::firstOrCreate(['name' => 'edit task']);
        $createPermission = Permission::firstOrCreate(['name' => 'create task']);
        $viewPermission = Permission::firstOrCreate(['name' => 'view task']);
        $deletePermission = Permission::firstOrCreate(['name' => 'delete task']);
        $feedbackPermission = Permission::firstOrCreate(['name' => 'give feedback']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($editPermission, $createPermission, $viewPermission, $deletePermission);
        $managerRole->givePermissionTo($editPermission, $viewPermission);
        $userRole->givePermissionTo($viewPermission, $feedbackPermission);

        // Create admin user if not exists
        $adminUser = User::firstOrCreate(
            ['email' => 'abdulwaseyjaved@yahoo.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('12345678'), // Replace with a secure password
            ]
        );

        // Assign admin role to admin user
        $adminUser->assignRole('admin');
    }
}
