@extends('admin.layouts.app')

@section('title', 'My Profile')
@section('header-title', 'My Profile')

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-user-circle mr-2 text-highlight"></i> My Profile
        </h2>
    </div>

    <!-- Profile Form -->
    @component('admin.components.card')
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Profile Picture -->
                <div class="flex flex-col items-center mb-6">
                    <div class="w-32 h-32 mb-4 relative">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" id="avatar-preview"
                                class="w-full h-full rounded-full object-cover">
                        @else
                            <div id="avatar-placeholder"
                                class="w-full h-full bg-bgPrimary rounded-full flex items-center justify-center text-2xl font-bold">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                            <img id="avatar-preview" class="w-full h-full rounded-full object-cover hidden" alt="Preview">
                        @endif

                        <label for="avatar"
                            class="absolute bottom-0 right-0 bg-highlight text-white p-2 rounded-full cursor-pointer hover:bg-opacity-80 transition-all">
                            <i class="fas fa-camera"></i>
                            <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <p class="text-sm text-textParagraph mb-2">Click the camera icon to update your profile picture</p>
                </div>

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
                    <h3 class="text-lg font-medium text-textHeading mb-4">Change Password</h3>
                    <p class="text-sm text-textParagraph mb-4">Leave password fields empty if you don't want to change the
                        password.</p>

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
                            <label for="password_confirmation" class="block text-sm font-medium text-textHeading mb-1">Confirm
                                New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="input-field w-full" placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i> Update Profile
                </button>
            </div>
        </form>
    @endcomponent
@endsection

@push('scripts')
<script>
    // Preview uploaded avatar
    document.getElementById('avatar').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(event) {
                const preview = document.getElementById('avatar-preview');
                preview.src = event.target.result;
                preview.classList.remove('hidden');
                
                // Hide placeholder if it exists
                const placeholder = document.getElementById('avatar-placeholder');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endpush
