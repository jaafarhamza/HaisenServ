<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Security Settings</h2>
    
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Change Password</h3>
        
        <form action="{{ route('profile.updatePassword') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Current Password
                </label>
                <input type="password" name="current_password" id="current_password" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    New Password
                </label>
                <input type="password" name="password" id="password" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Confirm New Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition duration-200">
                    Update Password
                </button>
            </div>
        </form>
    </div>
    
    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Account Security</h3>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <div>
                    <h4 class="font-medium text-gray-900 dark:text-white">Two-Factor Authentication</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Add an extra layer of security to your account.</p>
                </div>
                <button type="button" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500">
                    Setup
                </button>
            </div>
            
            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <div>
                    <h4 class="font-medium text-gray-900 dark:text-white">Login Sessions</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage your active sessions and logout from other devices.</p>
                </div>
                <button type="button" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500">
                    View
                </button>
            </div>
        </div>
    </div>
</div>