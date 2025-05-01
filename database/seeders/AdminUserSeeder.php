<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            $adminRole = Role::create([
                'name' => 'admin',
                'description' => 'Administrator'
            ]);
        }

        // Create admin user
        $admin = User::where('email', 'admin@haisenserv.com')->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@haisenserv.com',
                'password' => Hash::make('Admin123!'),
                'email_verified_at' => now(),
            ]);
        }

        // Assign admin role to user
        $admin->roles()->syncWithoutDetaching($adminRole);
    }
}