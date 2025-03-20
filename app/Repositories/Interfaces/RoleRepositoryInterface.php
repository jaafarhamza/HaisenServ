<?php
namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    public function getAllRoles(): Collection;
    public function getRoleById(int $id): ?Role;
    public function getRoleByName(string $name): ?Role;
    public function createRole(array $data): Role;
    public function updateRole(Role $role, array $data): bool;
    public function deleteRole(int $id): bool;
    public function syncPermissions(Role $role, array $permissionIds): void;
}