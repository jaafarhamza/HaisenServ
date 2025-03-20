<?php

namespace App\Repositories\Interfaces;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

interface PermissionRepositoryInterface
{
    public function getAllPermissions(): Collection;
    public function getPermissionById(int $id): ?Permission;
    public function getPermissionByName(string $name): ?Permission;
    public function createPermission(array $data): Permission;
    public function updatePermission(Permission $permission, array $data): bool;
    public function deletePermission(int $id): bool;
}