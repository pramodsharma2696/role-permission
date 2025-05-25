<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create super admin role
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);

        // Assign all permissions to this role
        $allPermissions = Permission::all();
        $superAdminRole->syncPermissions($allPermissions);

        // Assign this role to your initial admin user
        $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin123@yopmail.com',
                'password' => bcrypt('admin123'),
            ]);

        $admin->assignRole($superAdminRole);

         User::factory(5)->create();
    }
}
