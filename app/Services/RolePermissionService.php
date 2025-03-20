<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class RolePermissionService
{
    protected $roleRepository;
    protected $permissionRepository;
    protected $userRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->userRepository = $userRepository;
    }

    public function assignRoleToUser(User $user, string $roleName): void
    {
        $role = $this->roleRepository->getRoleByName($roleName);
        
        if (!$role) {
            throw new \Exception("Role {$roleName} not found");
        }
        
        $user->assignRole($role);
    }

    public function removeRoleFromUser(User $user, string $roleName): void
    {
        $role = $this->roleRepository->getRoleByName($roleName);
        
        if (!$role) {
            throw new \Exception("Role {$roleName} not found");
        }
        
        $user->removeRole($role);
    }

    public function createRole(string $name, string $description = null, array $permissionNames = []): void
    {
        $role = $this->roleRepository->createRole([
            'name' => $name,
            'description' => $description,
        ]);

        if (!empty($permissionNames)) {
            $permissions = $this->permissionRepository->getAllPermissions()
                ->whereIn('name', $permissionNames)
                ->pluck('id')
                ->toArray();
                
            $this->roleRepository->syncPermissions($role, $permissions);
        }
    }

    public function seedDefaultRoles(): void
    {
        // Create admin role with all permissions
        $adminRole = $this->roleRepository->createRole([
            'name' => 'admin',
            'description' => 'Administrator with full access',
        ]);

        // Create provider role with provider-specific permissions
        $providerRole = $this->roleRepository->createRole([
            'name' => 'provider',
            'description' => 'Service provider',
        ]);

        // Create client role with client-specific permissions
        $clientRole = $this->roleRepository->createRole([
            'name' => 'client',
            'description' => 'Service client',
        ]);

        // basic permissions
        $permissions = [
            // User management permissions
            ['name' => 'manage-users', 'description' => 'Can manage all users'],
            ['name' => 'manage-roles', 'description' => 'Can manage roles and permissions'],
            
            // Service permissions
            ['name' => 'create-service', 'description' => 'Can create a service'],
            ['name' => 'edit-service', 'description' => 'Can edit own service'],
            ['name' => 'delete-service', 'description' => 'Can delete own service'],
            ['name' => 'manage-services', 'description' => 'Can manage all services'],
            
            // Booking permissions
            ['name' => 'create-booking', 'description' => 'Can create a booking'],
            ['name' => 'manage-bookings', 'description' => 'Can manage all bookings'],
            ['name' => 'view-bookings', 'description' => 'Can view own bookings'],
            
            // Review permissions
            ['name' => 'create-review', 'description' => 'Can create a review'],
            ['name' => 'manage-reviews', 'description' => 'Can manage all reviews'],
        ];

        foreach ($permissions as $permData) {
            $this->permissionRepository->createPermission($permData);
        }

        // Assign permissions to admin
        $allPermissions = $this->permissionRepository->getAllPermissions()->pluck('id')->toArray();
        $this->roleRepository->syncPermissions($adminRole, $allPermissions);

        // Assign provider-specific permissions
        $providerPermissions = $this->permissionRepository->getAllPermissions()
            ->whereIn('name', [
                'create-service', 'edit-service', 'delete-service', 
                'view-bookings'
            ])
            ->pluck('id')
            ->toArray();
        $this->roleRepository->syncPermissions($providerRole, $providerPermissions);

        // Assign client-specific permissions
        $clientPermissions = $this->permissionRepository->getAllPermissions()
            ->whereIn('name', [
                'create-booking', 'view-bookings', 'create-review'
            ])
            ->pluck('id')
            ->toArray();
        $this->roleRepository->syncPermissions($clientRole, $clientPermissions);
    }
}