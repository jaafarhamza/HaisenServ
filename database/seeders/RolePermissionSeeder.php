<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\AuthorizationService;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(AuthorizationService $authorizationService): void
    {
        $authorizationService->setupInitialRolesAndPermissions();
    }
}