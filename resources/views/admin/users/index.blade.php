@extends('admin.layouts.app')

@section('title', 'Users Management')
@section('header-title', 'Users Management')

@section('search-route', route('admin.users.index'))

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-users mr-2 text-highlight"></i> Users Management
        </h2>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i> Add New User
        </a>
    </div>
    
    <!-- Users List -->
    @component('admin.components.card')
        @slot('header')
            Users List
        @endslot

        @slot('headerActions')
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                <form action="{{ route('admin.users.index') }}" method="GET" class="flex space-x-2">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search users..." 
                               class="input-field" value="{{ request('search') }}">
                        <button type="submit" class="absolute right-3 top-3 text-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <select name="role" class="input-field" onchange="this.form.submit()">
                        <option value="">All Roles</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        @endslot

        @slot('noPadding', true)
        
        @component('admin.components.table')
            @slot('header')
                <th scope="col" class="table-header">#</th>
                <th scope="col" class="table-header">Name</th>
                <th scope="col" class="table-header">Email</th>
                <th scope="col" class="table-header">Roles</th>
                <th scope="col" class="table-header">Created At</th>
                <th scope="col" class="table-header text-right">Actions</th>
            @endslot
            
            @forelse($users as $user)
                <tr class="hover:bg-bgPrimary transition-colors duration-150">
                    <td class="table-cell">{{ $loop->iteration }}</td>
                    <td class="table-cell font-medium text-textHeading">
                        <div class="flex items-center">
                            <div class="avatar mr-3">
                                @if($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <span>{{ substr($user->name, 0, 2) }}</span>
                                @endif
                            </div>
                            {{ $user->name }}
                        </div>
                    </td>
                    <td class="table-cell">{{ $user->email }}</td>
                    <td class="table-cell">
                        <div class="flex flex-wrap gap-1">
                            @forelse($user->roles as $role)
                                @php
                                    $colors = [
                                        'admin' => 'highlight',
                                        'provider' => 'tertiary',
                                        'client' => 'blue-500',
                                    ];
                                    $color = $colors[$role->name] ?? 'gray-500';
                                @endphp
                                <span class="badge" style="background-color: var(--color-{{ $color }})">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @empty
                                <span class="text-xs text-secondary">No roles assigned</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="table-cell">{{ $user->created_at->format('Y-m-d') }}</td>
                    <td class="table-cell text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn-secondary py-1 px-2" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary py-1 px-2" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== auth()->id())
                                <button class="btn-danger py-1 px-2" title="Delete" 
                                        onclick="showModal('delete-user-modal-{{ $user->id }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="table-cell text-center py-8">
                        <div class="flex flex-col items-center justify-center">
                            <div class="h-16 w-16 bg-bgPrimary rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-users text-secondary text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-textHeading mb-1">No users found</h3>
                            <p class="text-textParagraph">No users match your search criteria.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            
            @slot('pagination')
                <p class="text-sm text-secondary">
                    Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users
                </p>
                
                {{ $users->links('admin.components.pagination') }}
            @endslot
        @endcomponent
    @endcomponent
    
    <!-- Delete Confirmation Modals -->
    @foreach($users as $user)
        @if($user->id !== auth()->id())
            @include('admin.partials.modals.delete-confirmation', [
                'id' => $user->id,
                'name' => "user '{$user->name}'",
                'model' => 'user',
                'route' => route('admin.users.destroy', $user->id),
                'warning' => 'This will permanently remove the user and all of their role assignments.'
            ])
        @endif
    @endforeach
@endsection