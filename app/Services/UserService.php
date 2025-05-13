<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function createUser(array $data)
    {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        // Create the user
        $user = $this->userRepository->createUser($data);
        
        // Assign default role if specified
        if (isset($data['role'])) {
            $this->assignRole($user->id, $data['role']);
        }
        
        return $user;
    }

    public function updateUser($id, array $data)
    {
        // Get the user first
        $user = $this->userRepository->getUserById($id);
        
        if (!$user) {
            throw new \Exception('User not found.');
        }
        
        // Hash password only if a new one is provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        return $this->userRepository->updateUser($user, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }

    public function assignRole($userId, $roleName)
    {
        // Get the user
        $user = $this->userRepository->getUserById($userId);
        
        if (!$user) {
            throw new \Exception('User not found.');
        }
        
        // Get the role
        $role = $this->roleRepository->getRoleByName($roleName);
        
        if (!$role) {
            throw new \Exception('Role not found.');
        }
        
        // Assign the role
        $user->assignRole($role);
        
        return true;
    }

    public function removeRole($userId, $roleName)
    {
        // Get the user
        $user = $this->userRepository->getUserById($userId);
        
        if (!$user) {
            throw new \Exception('User not found.');
        }
        
        // Get the role
        $role = $this->roleRepository->getRoleByName($roleName);
        
        if (!$role) {
            throw new \Exception('Role not found.');
        }
        
        // Remove the role
        $user->removeRole($role);
        
        return true;
    }

    public function getUsersByRole($roleName)
    {
        $role = $this->roleRepository->getRoleByName($roleName);
        
        if (!$role) {
            throw new \Exception('Role not found.');
        }
        
        return $role->users;
    }

    public function banUser($userId, $reason, $days = null)
    {
        $user = $this->userRepository->getUserById($userId);
        
        if (!$user) {
            throw new \Exception('User not found.');
        }
        
        // Ban until specific date, or permanently if days is null
        $bannedUntil = $days ? now()->addDays($days) : now()->setYear(2999);
        
        return $this->userRepository->updateUser($userId, [
            'banned_until' => $bannedUntil,
            'ban_reason' => $reason,
        ]);
    }

    public function unbanUser($userId)
    {
        $user = $this->userRepository->getUserById($userId);
        
        if (!$user) {
            throw new \Exception('User not found.');
        }
        
        return $this->userRepository->updateUser($userId, [
            'banned_until' => null,
            'ban_reason' => null,
        ]);
    }

    public function getProviders()
    {
        return $this->getUsersByRole('provider');
    }

    public function getClients()
    {
        return $this->getUsersByRole('client');
    }

    public function getAdmins()
    {
        return $this->getUsersByRole('admin');
    }
}
