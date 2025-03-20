@extends('admin.layouts.app')

@section('title', 'User Details')
@section('header-title', 'User Details')

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-user mr-2 text-highlight"></i> User Details: {{ $user->name }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary">
                <i class="fas fa-edit mr-2"></i> Edit User
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Users
            </a>
        </div>
    </div>
    
    <!-- User Profile -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div>
            <!-- User Information -->
            @component('admin.components.card')
                @slot('header')
                    Basic Information
                @endslot
                
                <div class="flex flex-col items-center mb-6">
                    <div class="w-24 h-24 bg-bgPrimary rounded-full flex items-center justify-center mb-4 text-2xl font-bold">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover">
                        @else
                            {{ substr($user->name, 0, 2) }}
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-textHeading">{{ $user->name }}</h3>
                    <p class="text-textParagraph">{{ $user->email }}</p>
                </div>
                
                <div class="space-y-3">
                    <div>
                        <h4 class="text-sm font-medium text-secondary">Account Created</h4>
                        <p class="text-textHeading">{{ $user->created_at->format('F j, Y') }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary">Last Updated</h4>
                        <p class="text-textHeading">{{ $user->updated_at->format('F j, Y') }}</p>
                    </div>
                    
                    @if($user->email_verified_at)
                        <div>
                            <h4 class="text-sm font-medium text-secondary">Email Verified</h4>
                            <p class="text-textHeading">{{ $user->email_verified_at->format('F j, Y') }}</p>
                        </div>
                    @endif
                    
                    @if($user->google_id)
                        <div>
                            <h4 class="text-sm font-medium text-secondary">Authentication Provider</h4>
                            <div class="flex items-center">
                                <i class="fab fa-google text-red-500 mr-2"></i>
                                <span class="text-textHeading">Google</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endcomponent
            
            <!-- User Roles -->
            @component('admin.components.card', ['class' => 'mt-6'])
                @slot('header')
                    Assigned Roles
                @endslot
                
                @if($user->roles->isNotEmpty())
                    <div class="space-y-3">
                        @foreach($user->roles as $role)
                            @php
                                $colors = [
                                    'admin' => 'highlight',
                                    'provider' => 'tertiary',
                                    'client' => 'blue-500',
                                ];
                                $color = $colors[$role->name] ?? 'gray-500';
                            @endphp
                            <div class="p-3 rounded-lg" style="background-color: var(--color-{{ $color }}10);">
                                <div class="flex items-center mb-2">
                                    <span class="h-3 w-3 rounded-full mr-2" style="background-color: var(--color-{{ $color }})"></span>
                                    <h4 class="text-textHeading font-medium">{{ ucfirst($role->name) }}</h4>
                                </div>
                                @if($role->description)
                                    <p class="text-sm text-textParagraph">{{ $role->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                <div class="text-center py-6">
                    <div class="h-16 w-16 bg-bgPrimary rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-user-slash text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-textHeading mb-1">No Roles Assigned</h3>
                    <p class="text-textParagraph">This user has no roles assigned.</p>
                </div>
            @endif
            
            <div class="mt-4">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-highlight hover:underline text-sm">
                    <i class="fas fa-edit mr-1"></i> Edit Roles
                </a>
            </div>
        @endcomponent
    </div>
    
    <div class="lg:col-span-2">
        <!-- All Permissions -->
        @component('admin.components.card')
            @slot('header')
                User Permissions
            @endslot
            
            @if($allPermissions->isNotEmpty())
                <div class="mb-4">
                    <p class="text-sm text-textParagraph">
                        This user has the following permissions through assigned roles:
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($allPermissions->groupBy('group') as $group => $permissions)
                        <div class="bg-bgPrimary rounded-lg p-4">
                            <h4 class="font-medium text-highlight mb-3">{{ $group ?? 'Other' }}</h4>
                            <ul class="space-y-2">
                                @foreach($permissions as $permission)
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-tertiary mr-2"></i>
                                        <span class="text-sm text-textHeading">{{ $permission->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="h-16 w-16 bg-bgPrimary rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-lock text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-textHeading mb-2">No Permissions</h3>
                    <p class="text-textParagraph max-w-md mx-auto">
                        This user doesn't have any permissions. Assign roles to grant permissions.
                    </p>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary mt-4">
                        <i class="fas fa-edit mr-2"></i> Assign Roles
                    </a>
                </div>
            @endif
        @endcomponent
        
        <!-- Permissions by Role -->
        @if($user->roles->isNotEmpty())
            @component('admin.components.card', ['class' => 'mt-6'])
                @slot('header')
                    Permissions by Role
                @endslot
                
                <div class="space-y-6">
                    @foreach($permissionsByRole as $roleName => $rolePermissions)
                        @php
                            $colors = [
                                'admin' => 'highlight',
                                'provider' => 'tertiary',
                                'client' => 'blue-500',
                            ];
                            $color = $colors[$roleName] ?? 'gray-500';
                        @endphp
                        <div>
                            <h4 class="font-medium mb-3" style="color: var(--color-{{ $color }})">
                                <i class="fas fa-user-tag mr-2"></i> {{ ucfirst($roleName) }}
                            </h4>
                            
                            @if($rolePermissions->isNotEmpty())
                                <div class="bg-bgPrimary rounded-lg p-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                                        @foreach($rolePermissions as $permission)
                                            <div class="text-sm bg-bgSecondary rounded px-3 py-2 flex items-center">
                                                <i class="fas fa-key text-xs mr-2 opacity-70"></i>
                                                <span>{{ $permission->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-textParagraph bg-bgPrimary rounded-lg p-4">
                                    This role doesn't have any specific permissions assigned.
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endcomponent
        @endif
    </div>
</div>
@endsection