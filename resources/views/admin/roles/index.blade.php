@extends('admin.layouts.app')

@section('title', 'Roles Management')
@section('header-title', 'Roles Management')

@section('search-route', route('admin.roles.index'))

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-user-shield mr-2 text-highlight"></i> Roles Management
        </h2>
        <button class="btn-primary" onclick="showModal('create-role-modal')">
            <i class="fas fa-plus mr-2"></i> Add New Role
        </button>
    </div>
    
    <!-- Stats Cards -->
    @php
        $stats = [
            [
                'title' => 'Total Roles',
                'value' => $rolesCount,
                'icon' => 'user-shield',
                'color' => 'highlight',
                'change' => $rolesChange,
            ],
            [
                'title' => 'Total Permissions',
                'value' => $permissionsCount,
                'icon' => 'key',
                'color' => 'tertiary',
                'change' => $permissionsChange,
            ],
            [
                'title' => 'Total Users',
                'value' => $usersCount,
                'icon' => 'users',
                'color' => 'blue-500',
                'change' => $usersChange,
            ],
            
        ];
    @endphp
    
    @include('admin.partials.stats-cards', ['stats' => $stats])
    
    <!-- Roles List -->
    @component('admin.components.card')
        @slot('header')
            Roles List
        @endslot

        @slot('headerActions')
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                <div class="relative">
                    <form action="{{ route('admin.roles.index') }}" method="GET">
                        <input type="text" name="search" placeholder="Search roles..." 
                               class="input-field" value="{{ request('search') }}">
                        <button type="submit" class="absolute right-3 top-3 text-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endslot

        @slot('noPadding', true)
        
        @component('admin.components.table')
            @slot('header')
                <th scope="col" class="table-header">#</th>
                <th scope="col" class="table-header">Name</th>
                <th scope="col" class="table-header">Description</th>
                <th scope="col" class="table-header">Users</th>
                <th scope="col" class="table-header">Permissions</th>
                <th scope="col" class="table-header">Created At</th>
                <th scope="col" class="table-header text-right">Actions</th>
            @endslot
            
            @forelse($roles as $role)
                <tr class="hover:bg-bgPrimary transition-colors duration-150">
                    <td class="table-cell">{{ $loop->iteration }}</td>
                    <td class="table-cell font-medium text-textHeading">
                        <div class="flex items-center">
                            @php
                                $colors = [
                                    'admin' => 'highlight',
                                    'provider' => 'tertiary',
                                    'client' => 'blue-500',
                                ];
                                $icons = [
                                    'admin' => 'user-shield',
                                    'provider' => 'user-tie',
                                    'client' => 'user',
                                ];
                                $color = $colors[$role->name] ?? 'gray-500';
                                $icon = $icons[$role->name] ?? 'user-alt';
                            @endphp
                            <div class="h-8 w-8 rounded-md bg-{{ $color }} mr-3 flex items-center justify-center">
                                <i class="fas fa-{{ $icon }} text-white"></i>
                            </div>
                            {{ $role->name }}
                        </div>
                    </td>
                    <td class="table-cell">{{ Str::limit($role->description, 50) }}</td>
                    <td class="table-cell">
                        <span class="badge badge-primary">{{ $role->users_count }} users</span>
                    </td>
                    <td class="table-cell">
                        <span class="badge badge-success">{{ $role->permissions_count }} permissions</span>
                    </td>
                    <td class="table-cell">{{ $role->created_at->format('Y-m-d') }}</td>
                    <td class="table-cell text-right">
                        <div class="flex justify-end space-x-2">
                            <button class="btn-primary py-1 px-2" title="Edit" 
                                    onclick="showModal('edit-role-modal-{{ $role->id }}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if(!in_array($role->name, ['admin', 'provider', 'client']))
                                <button class="btn-danger py-1 px-2" title="Delete" 
                                        onclick="showModal('delete-role-modal-{{ $role->id }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="table-cell text-center py-8">
                        <div class="flex flex-col items-center justify-center">
                            <div class="h-16 w-16 bg-bgPrimary rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-user-shield text-secondary text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-textHeading mb-1">No roles found</h3>
                            <p class="text-textParagraph">No roles match your search criteria.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            
            @slot('pagination')
                <p class="text-sm text-secondary">
                    Showing {{ $roles->firstItem() ?? 0 }} to {{ $roles->lastItem() ?? 0 }} of {{ $roles->total() }} roles
                </p>
                
                {{ $roles->links('admin.components.pagination') }}
            @endslot
        @endcomponent
    @endcomponent
    
    <!-- Create Role Modal -->
    @include('admin.partials.modals.create-role')
    
    <!-- Edit Role Modals -->
    @foreach($roles as $role)
        @include('admin.partials.modals.edit-role', ['role' => $role])
        
        @if(!in_array($role->name, ['admin', 'provider', 'client']))
            @include('admin.partials.modals.delete-confirmation', [
                'id' => $role->id,
                'name' => "role '{$role->name}'",
                'model' => 'role',
                'route' => route('admin.roles.destroy', $role->id),
                'warning' => 'This will also remove all associated permissions from this role.'
            ])
        @endif
    @endforeach
@endsection