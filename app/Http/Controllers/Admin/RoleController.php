<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;
    protected $userRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository,

    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        // Get all roles with user count and permission count
        $query = Role::withCount(['users', 'permissions']);

        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $roles = $query->latest()->paginate(10);

        // Get statistics for cards
        $rolesCount = Role::count();
        $permissionsCount = Permission::count();
        $usersCount = User::count();
        $adminCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();

        // For illustration purposes
        $rolesChange = 2;
        $permissionsChange = 3;
        $usersChange = 12;
        $adminChange = 1;
        $permissions = Permission::all();
        $permissionGroups = [];

        foreach ($permissions as $permission) {
            $group = $permission->group ?? 'Other';
            if (!isset($permissionGroups[$group])) {
                $permissionGroups[$group] = [];
            }
            $permissionGroups[$group][] = $permission;
        }

        return view('admin.roles.index', compact(
            'roles',
            'permissionGroups',
            'rolesCount',
            'permissionsCount',
            'usersCount',
            'adminCount',
            'rolesChange',
            'permissionsChange',
            'usersChange',
            'adminChange'
        ));
    }

    public function create()
    {
        $permissions = $this->permissionRepository->getAllPermissions();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        DB::beginTransaction();

        try {
            // Create role
            $role = $this->roleRepository->createRole([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]);

            // Sync permissions if provided
            if (isset($validated['permissions'])) {
                $this->roleRepository->syncPermissions($role, $validated['permissions']);
            }

            DB::commit();

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to create role: ' . $e->getMessage())
                ->withInput();
        }
    }
    

    public function edit($id)
    {
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $this->permissionRepository->getAllPermissions();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function show(Role $role)
    {
        $role->load(['permissions', 'users']);
        
        return view('admin.roles.show', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles')->ignore($role->id),
            ],
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Update role
            $this->roleRepository->updateRole($role, [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]);
            
            // Sync permissions if provided
            if (isset($validated['permissions'])) {
                $this->roleRepository->syncPermissions($role, $validated['permissions']);
            } else {
                $this->roleRepository->syncPermissions($role, []);
            }
            
            DB::commit();
            
            return redirect()->route('admin.roles.index')
                ->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to update role: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Role $role)
    {
        // Prevent deletion of default roles
        if (in_array($role->name, ['admin', 'provider', 'client'])) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Cannot delete default roles');
        }
        
        DB::beginTransaction();
        
        try {
            // Detach all permissions and users first
            $role->permissions()->detach();
            $role->users()->detach();
            
            // Delete the role
            $this->roleRepository->deleteRole($role->id);
            
            DB::commit();
            
            return redirect()->route('admin.roles.index')
                ->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }
}