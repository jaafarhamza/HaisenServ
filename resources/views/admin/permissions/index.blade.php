@extends('admin.layouts.app')

@section('title', 'Permissions Management')
@section('header-title', 'Permissions Management')

@section('search-route', route('admin.permissions.index'))

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-key mr-2 text-highlight"></i> Permissions Management
        </h2>
        <button class="btn-primary" onclick="showModal('create-permission-modal')">
            <i class="fas fa-plus mr-2"></i> Add New Permission
        </button>
    </div>
    
    <!-- Permissions List -->
    @component('admin.components.card')
        @slot('header')
            Permissions List
        @endslot

        @slot('headerActions')
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                <div class="relative">
                    <form action="{{ route('admin.permissions.index') }}" method="GET" class="flex space-x-2">
                        <input type="text" name="search" placeholder="Search permissions..." 
                               class="input-field" value="{{ request('search') }}">
                        
                        <select name="group" class="input-field">
                            <option value="">All Groups</option>
                            @foreach($groups as $group)
                                <option value="{{ $group }}" {{ request('group') == $group ? 'selected' : '' }}>
                                    {{ $group }}
                                </option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="btn-secondary">
                            <i class="fas fa-search mr-1"></i> Filter
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
                <th scope="col" class="table-header">Group</th>
                <th scope="col" class="table-header">Guard</th>
                <th scope="col" class="table-header">Roles</th>
                <th scope="col" class="table-header text-right">Actions</th>
            @endslot
            
            @forelse($permissions as $permission)
                <tr class="hover:bg-bgPrimary transition-colors duration-150">
                    <td class="table-cell">{{ $loop->iteration }}</td>
                    <td class="table-cell font-medium text-textHeading">{{ $permission->name }}</td>
                    <td class="table-cell">{{ Str::limit($permission->description, 50) }}</td>
                    <td class="table-cell">
                        <span class="badge badge-primary">{{ $permission->group ?? 'Uncategorized' }}</span>
                    </td>
                    <td class="table-cell">{{ $permission->guard_name }}</td>
                    <td class="table-cell">
                        <span class="badge badge-success">{{ $permission->roles_count }} roles</span>
                    </td>
                    <td class="table-cell text-right">
                        <div class="flex justify-end space-x-2">
                            <button class="btn-primary py-1 px-2" title="Edit" 
                                    onclick="showModal('edit-permission-modal-{{ $permission->id }}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            @if(!in_array($permission->name, ['manage-roles', 'manage-permissions', 'manage-users']))
                                <button class="btn-danger py-1 px-2" title="Delete" 
                                        onclick="showModal('delete-permission-modal-{{ $permission->id }}')">
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
                                <i class="fas fa-key text-secondary text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-textHeading mb-1">No permissions found</h3>
                            <p class="text-textParagraph">No permissions match your search criteria.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            
            @slot('pagination')
                <p class="text-sm text-secondary">
                    Showing {{ $permissions->firstItem() ?? 0 }} to {{ $permissions->lastItem() ?? 0 }} of {{ $permissions->total() }} permissions
                </p>
                
                {{ $permissions->links('admin.components.pagination') }}
            @endslot
        @endcomponent
    @endcomponent
    
    <!-- Create Permission Modal -->
    @include('admin.partials.modals.create-permission')
    
    <!-- Edit Permission Modals -->
    @foreach($permissions as $permission)
        @include('admin.partials.modals.edit-permission', ['permission' => $permission])
        
        @if(!in_array($permission->name, ['manage-roles', 'manage-permissions', 'manage-users']))
            @include('admin.partials.modals.delete-confirmation', [
                'id' => $permission->id,
                'name' => "permission '{$permission->name}'",
                'model' => 'permission',
                'route' => route('admin.permissions.destroy', $permission->id),
                'warning' => 'This will also remove this permission from all roles.'
            ])
        @endif
    @endforeach
@endsection