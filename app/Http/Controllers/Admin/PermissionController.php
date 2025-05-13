<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function index(Request $request)
    {
        // Get all permissions with role count
        $query = Permission::withCount(['roles']);
        
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Apply group filter if provided
        if ($request->has('group') && !empty($request->group)) {
            $query->where('group', $request->group);
        }
        
        $permissions = $query->latest()->paginate(15);
        
        // Get all unique groups for the filter dropdown
        $groups = Permission::select('group')
            ->whereNotNull('group')
            ->distinct()
            ->pluck('group')
            ->toArray();
        
        $permissionGroups = array_unique(array_merge($groups, ['User Management', 'Role Management', 'Service Management', 'Booking Management']));
        
        return view('admin.permissions.index', compact('permissions', 'groups', 'permissionGroups'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:permissions,name',
            'description' => 'nullable|string|max:255',
            'group' => 'nullable|string|max:50',
            'new_group' => 'nullable|string|max:50|required_if:group,new',
            'guard_name' => 'required|string|in:web,api',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Determine the group
            $group = $validated['group'];
            if ($group === 'new' && !empty($validated['new_group'])) {
                $group = $validated['new_group'];
            }
            
            // Create permission
            $permission = $this->permissionRepository->createPermission([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'group' => $group === '' ? null : $group,
                'guard_name' => $validated['guard_name'],
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permission created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to create permission: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('permissions')->ignore($permission->id),
            ],
            'description' => 'nullable|string|max:255',
            'group' => 'nullable|string|max:50',
            'new_group' => 'nullable|string|max:50|required_if:group,new',
            'guard_name' => 'required|string|in:web,api',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Determine the group
            $group = $validated['group'];
            if ($group === 'new' && !empty($validated['new_group'])) {
                $group = $validated['new_group'];
            }
            
            // Update permission
            $this->permissionRepository->updatePermission($permission, [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'group' => $group === '' ? null : $group,
                'guard_name' => $validated['guard_name'],
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to update permission: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Permission $permission)
    {
        // Prevent deletion of critical permissions
        if (in_array($permission->name, ['manage-roles', 'manage-permissions', 'manage-users'])) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'Cannot delete critical system permissions');
        }
        
        DB::beginTransaction();
        
        try {
            // Detach all roles first
            $permission->roles()->detach();
            
            // Delete the permission
            $this->permissionRepository->deletePermission($permission->id);
            
            DB::commit();
            
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to delete permission: ' . $e->getMessage());
        }
    }
    
    
    public function assignToRoles(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);
        
        DB::beginTransaction();
        
        try {
            $permission->roles()->sync($validated['roles']);
            
            DB::commit();
            
            return redirect()->back()
                ->with('success', 'Permission assigned to roles successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to assign permission to roles: ' . $e->getMessage());
        }
    }

}
        
    