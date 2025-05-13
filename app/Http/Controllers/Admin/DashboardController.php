<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // User statistics
        $usersCount = User::count();
        
        $providerCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'provider');
        })->count();
        $clientCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();
        
        $servicesCount = Service::count();
        $categoriesCount = Category::count();
        $bookingsCount = 256;

        $usersChange = 12;
        $providersChange = 5;
        $servicesChange = -3;
        $bookingsChange = 15;
        $categoriesChange = 4;

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
            'servicesCount',
            'bookingsCount',
            'usersChange',
            'providersChange',
            'servicesChange',
            'bookingsChange',
            'roleDistribution',
        ));
    }
}