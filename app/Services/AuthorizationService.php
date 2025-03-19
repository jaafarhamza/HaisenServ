<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class AuthorizationService
{
    public function createRole(array $data): Role
    {
        return Role::create($data);
    }

    public function createPermission(array $data): Permission
    {
        return Permission::create($data);
    }

    public function assignPermissionToRole(Role $role, Permission $permission): void
    {
        $role->assignPermission($permission);
    }

    public function assignRoleToUser(User $user, Role $role): void
    {
        $user->assignRole($role);
    }

    public function setupInitialRolesAndPermissions(): void
    {
        // Permissions
        $viewServicePermission = Permission::firstOrCreate([
            'name' => 'view_service',
            'description' => 'Can view service details'
        ]);

        $bookServicePermission = Permission::firstOrCreate([
            'name' => 'book_service',
            'description' => 'Can book a service'
        ]);

        $manageServicePermission = Permission::firstOrCreate([
            'name' => 'manage_service',
            'description' => 'Can manage services'
        ]);

        // Roles
        $clientRole = Role::firstOrCreate([
            'name' => 'client',
            'description' => 'Regular service client'
        ]);

        $providerRole = Role::firstOrCreate([
            'name' => 'service_provider',
            'description' => 'Service provider'
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'description' => 'Platform administrator'
        ]);


        $clientRole->assignPermission($viewServicePermission);
        $clientRole->assignPermission($bookServicePermission);

        $providerRole->assignPermission($viewServicePermission);
        $providerRole->assignPermission($manageServicePermission);

        $adminRole->assignPermission($viewServicePermission);
        $adminRole->assignPermission($bookServicePermission);
        $adminRole->assignPermission($manageServicePermission);
    }
}