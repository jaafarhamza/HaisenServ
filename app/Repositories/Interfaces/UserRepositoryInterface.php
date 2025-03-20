<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers(): Collection;
    public function getUserById(int $id): ?User;
    public function getUserByEmail(string $email): ?User;
    public function getUserByGoogleId(string $googleId): ?User;
    public function createUser(array $data): User;
    public function updateUser(User $user, array $data): bool;
    public function deleteUser(int $id): bool;
    public function findOrCreateGoogleUser(array $userData): User;

    public function assignRoleToUser(User $user, string $roleName): void;
    public function removeRoleFromUser(User $user, string $roleName): void;
    public function getUsersWithRole(string $roleName): Collection;
    public function createUserWithRole(array $data, string $roleName): User;
}