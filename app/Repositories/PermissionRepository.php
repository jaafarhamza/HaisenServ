<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $model;

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function getAllPermissions(): Collection
    {
        return $this->model->all();
    }

    public function getPermissionById(int $id): ?Permission
    {
        return $this->model->find($id);
    }

    public function getPermissionByName(string $name): ?Permission
    {
        return $this->model->where('name', $name)->first();
    }

    public function createPermission(array $data): Permission
    {
        return $this->model->create($data);
    }

    public function updatePermission(Permission $permission, array $data): bool
    {
        return $permission->update($data);
    }

    public function deletePermission(int $id): bool
    {
        return $this->model->destroy($id);
    }
}