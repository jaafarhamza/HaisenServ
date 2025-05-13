<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Profile Information</h2>
    
    <form action="{{ route('profile.updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Full Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email Address
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Phone Number
                </label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    City
                </label>
                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                @error('city')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mb-6">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Address
            </label>
            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
            @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Bio / About Me
            </label>
            <textarea name="bio" id="bio" rows="4" 
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Profile Picture
            </label>
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-full overflow-hidden">
                    <img src="{{ $user->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}" 
                        alt="{{ $user->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <input type="file" name="avatar" id="avatar"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Upload a new profile picture (JPEG, PNG, GIF).
                    </p>
                </div>
            </div>
            @error('avatar')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition duration-200">
                Save Changes
            </button>
        </div>
    </form>
</div>