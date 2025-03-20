<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Administrator with full access',
        ]);
        
        $providerRole = Role::create([
            'name' => 'provider',
            'description' => 'Service provider with limited access',
        ]);
        
        $clientRole = Role::create([
            'name' => 'client',
            'description' => 'Standard user with basic permissions',
        ]);
        
        // Create permissions by group
        $permissionGroups = [
            'User Management' => [
                'view-users' => 'Can view list of users',
                'create-users' => 'Can create new users',
                'edit-users' => 'Can edit users',
                'delete-users' => 'Can delete users',
                'manage-users' => 'Can manage all aspects of users',
            ],
            'Role Management' => [
                'view-roles' => 'Can view list of roles',
                'create-roles' => 'Can create new roles',
                'edit-roles' => 'Can edit roles',
                'delete-roles' => 'Can delete roles',
                'manage-roles' => 'Can manage all aspects of roles',
            ],
            'Permission Management' => [
                'view-permissions' => 'Can view list of permissions',
                'create-permissions' => 'Can create new permissions',
                'edit-permissions' => 'Can edit permissions',
                'delete-permissions' => 'Can delete permissions',
                'manage-permissions' => 'Can manage all aspects of permissions',
            ],
            'Service Management' => [
                'view-services' => 'Can view list of services',
                'create-services' => 'Can create new services',
                'edit-services' => 'Can edit services',
                'delete-services' => 'Can delete services',
                'manage-services' => 'Can manage all aspects of services',
            ],
            'Booking Management' => [
                'view-bookings' => 'Can view list of bookings',
                'create-bookings' => 'Can create new bookings',
                'edit-bookings' => 'Can edit bookings',
                'delete-bookings' => 'Can delete bookings',
                'manage-bookings' => 'Can manage all aspects of bookings',
            ],
        ];
        
        $allPermissions = [];
        
        foreach ($permissionGroups as $group => $permissions) {
            foreach ($permissions as $name => $description) {
                $permission = Permission::create([
                    'name' => $name,
                    'description' => $description,
                    'guard_name' => 'web',
                    'group' => $group,
                ]);
                
                $allPermissions[] = $permission->id;
            }
        }
        
        // Assign all permissions to admin role
        $adminRole->permissions()->sync($allPermissions);
        
        // Assign specific permissions to provider role
        $providerPermissions = Permission::whereIn('name', [
            'view-services',
            'create-services',
            'edit-services',
            'delete-services',
            'view-bookings',
        ])->pluck('id')->toArray();
        
        $providerRole->permissions()->sync($providerPermissions);
        
        // Assign specific permissions to client role
        $clientPermissions = Permission::whereIn('name', [
            'view-services',
            'create-bookings',
            'view-bookings',
        ])->pluck('id')->toArray();
        
        $clientRole->permissions()->sync($clientPermissions);
        
        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        
        $adminUser->roles()->attach($adminRole);
        
        // Create provider user
        $providerUser = User::create([
            'name' => 'Provider User',
            'email' => 'provider@example.com',
            'password' => Hash::make('password'),
        ]);
        
        $providerUser->roles()->attach($providerRole);
        
        // Create client user
        $clientUser = User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
        ]);
        
        $clientUser->roles()->attach($clientRole);
    
    }
}