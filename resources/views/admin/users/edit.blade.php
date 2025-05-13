@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('header-title', 'Edit User')

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-user-edit mr-2 text-highlight"></i> Edit User: {{ $user->name }}
        </h2>
        <a href="{{ route('admin.users.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Users
        </a>
    </div>
    
    <!-- Edit User Form -->
    @component('admin.components.card')
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-medium text-textHeading mb-4">Personal Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-textHeading mb-1">Full Name</label>
                            <input type="text" id="name" name="name" class="input-field w-full" 
                                   placeholder="Enter full name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-textHeading mb-1">Email Address</label>
                            <input type="email" id="email" name="email" class="input-field w-full" 
                                   placeholder="Enter email address" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Password Information -->
                <div>
                    <h3 class="text-lg font-medium text-textHeading mb-4">Password</h3>
                    <p class="text-sm text-textParagraph mb-4">Leave password fields empty if you don't want to change the password.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-textHeading mb-1">New Password</label>
                            <input type="password" id="password" name="password" class="input-field w-full" 
                                   placeholder="Enter new password">
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-textHeading mb-1">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="input-field w-full" 
                                   placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
                
                <!-- Roles Selection -->
                <div>
                    <h3 class="text-lg font-medium text-textHeading mb-4">Roles</h3>
                    
                    <div class="bg-bgPrimary rounded-lg p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($roles as $role)
                                <div class="flex items-center space-x-3 p-3 rounded-lg bg-bgSecondary">
                                    <input type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                                           class="rounded bg-bgSecondary border-secondary text-highlight focus:ring-highlight"
                                           {{ in_array($role->id, old('roles', $userRoleIds)) ? 'checked' : '' }}>
                                    <div>
                                        <label for="role-{{ $role->id }}" class="text-sm font-medium text-textHeading">
                                            {{ ucfirst($role->name) }}
                                        </label>
                                        @if($role->description)
                                            <p class="text-xs text-textParagraph">{{ $role->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @error('roles')
                            <p class="mt-3 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end mt-8">
                <button type="button" class="btn-secondary mr-3" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i> Update User
                </button>
            </div>
        </form>
    @endcomponent
@endsection