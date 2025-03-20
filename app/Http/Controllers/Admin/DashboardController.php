<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        // User statistics
        $usersCount = User::count();
        $adminCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();
        $providerCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'provider');
        })->count();
        $clientCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();
        $usersWithoutRolesCount = User::doesntHave('roles')->count();

        $rolesCount = Role::count();
        $permissionsCount = Permission::count();

        $servicesCount = 87;
        $bookingsCount = 256;

        $usersChange = 12;
        $providersChange = 5;
        $servicesChange = -3;
        $bookingsChange = 15;

        // Role distribution
        $roleDistribution = Role::withCount('users')
            ->get()
            ->map(function ($role) use ($usersCount) {
                $percentage = $usersCount > 0 ? round(($role->users_count / $usersCount) * 100, 1) : 0;

                return [
                    'name' => $role->name,
                    'count' => $role->users_count,
                    'percentage' => $percentage,
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->all();

        return view('admin.dashboard', compact(
            'usersCount',
            'providerCount',
            'clientCount',
            'adminCount',
            'rolesCount',
            'permissionsCount',
            'servicesCount',
            'bookingsCount',
            'usersChange',
            'providersChange',
            'servicesChange',
            'bookingsChange',
            'roleDistribution',
            'usersWithoutRolesCount'
        ));
    }
}