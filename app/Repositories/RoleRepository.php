<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function getAllRoles(): Collection
    {
        return $this->model->all();
    }

    public function getRoleById(int $id): ?Role
    {
        return $this->model->find($id);
    }

    public function getRoleByName(string $name): ?Role
    {
        return $this->model->where('name', $name)->first();
    }

    public function createRole(array $data): Role
    {
        return $this->model->create($data);
    }

    public function updateRole(Role $role, array $data): bool
    {
        return $role->update($data);
    }

    public function deleteRole(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function syncPermissions(Role $role, array $permissionIds): void
    {
        $role->permissions()->sync($permissionIds);
    }
}