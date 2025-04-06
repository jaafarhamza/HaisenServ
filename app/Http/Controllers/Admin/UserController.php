<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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

    public function index(Request $request)
    {
        // Get users with their roles
        $query = User::with('roles');

        // Apply search filter 
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role 
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->latest()->paginate(10);

        // Get all roles
        $roles = $this->roleRepository->getAllRoles();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = $this->roleRepository->getAllRoles();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        DB::beginTransaction();

        try {
            // Create user
            $user = $this->userRepository->createUser([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            // Assign roles if provided
            if (isset($validated['roles'])) {
                foreach ($validated['roles'] as $roleId) {
                    $role = $this->roleRepository->getRoleById($roleId);
                    if ($role) {
                        $user->assignRole($role);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to create user: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(User $user)
    {
        $user->load('roles.permissions');

        // Get all permissions grouped by role
        $permissionsByRole = [];
        foreach ($user->roles as $role) {
            $permissionsByRole[$role->name] = $role->permissions;
        }

        $allPermissions = $user->roles->flatMap(function ($role) {
            return $role->permissions;
        })->unique('id');

        return view('admin.users.show', compact('user', 'permissionsByRole', 'allPermissions'));
    }

    public function edit(User $user)
    {
        $roles = $this->roleRepository->getAllRoles();
        $userRoleIds = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoleIds'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        DB::beginTransaction();

        try {
            // Update user data
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            // Only update password if provided
            if (!empty($validated['password'])) {
                $userData['password'] = $validated['password'];
            }

            $this->userRepository->updateUser($user, $userData);

            // Sync roles
            if (isset($validated['roles'])) {
                $user->roles()->sync($validated['roles']);
            } else {
                $user->roles()->detach();
            }

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to update user: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account');
        }

        DB::beginTransaction();

        try {
            // Detach all roles first
            $user->roles()->detach();

            // Delete the user
            $this->userRepository->deleteUser($user->id);

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
    public function profile()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = '/storage/' . $avatarPath;
        }

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $this->userRepository->updateUser($user, $validated);

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully');
    }

    public function ban(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'You cannot ban yourself');
        }

        $validated = $request->validate([
            'ban_reason' => 'required|string|max:255',
            'ban_period' => 'required|string|in:1_day,7_days,30_days,permanent',
        ]);

        switch ($validated['ban_period']) {
            case '1_day':
                $bannedUntil = now()->addDay();
                break;
            case '7_days':
                $bannedUntil = now()->addDays(7);
                break;
            case '30_days':
                $bannedUntil = now()->addDays(30);
                break;
            case 'permanent':
                $bannedUntil = now()->setYear(2999); 
                break;
            default:
                $bannedUntil = now()->addDay();
        }

        $user->update([
            'banned_until' => $bannedUntil,
            'ban_reason' => $validated['ban_reason'],
        ]);

        return redirect()->route('admin.users.show', $user->id)
            ->with('success', 'User has been banned successfully');
    }

    public function unban(User $user)
    {
        $user->update([
            'banned_until' => null,
            'ban_reason' => null,
        ]);

        return redirect()->route('admin.users.show', $user->id)
            ->with('success', 'User has been unbanned successfully');
    }
}