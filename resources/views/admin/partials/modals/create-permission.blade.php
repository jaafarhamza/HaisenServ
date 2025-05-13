@component('admin.components.modal', [
    'id' => 'create-permission-modal',
    'title' => 'Add New Permission',
])
    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        
        <div class="space-y-4">
            <!-- Permission Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-textHeading mb-1">Permission Name</label>
                <input type="text" id="name" name="name" class="input-field w-full" 
                       placeholder="Enter permission name" value="{{ old('name') }}" required>
                <p class="text-xs text-secondary mt-1">Use format: verb-noun (e.g., create-users, view-reports)</p>
                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Permission Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-textHeading mb-1">Description</label>
                <textarea id="description" name="description" class="input-field w-full" rows="3" 
                          placeholder="Enter permission description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Permission Group -->
            <div>
                <label for="group" class="block text-sm font-medium text-textHeading mb-1">Group</label>
                <select id="group" name="group" class="input-field w-full">
                    <option value="">Select a group</option>
                    @foreach($permissionGroups as $group)
                        <option value="{{ $group }}" {{ old('group') == $group ? 'selected' : '' }}>
                            {{ $group }}
                        </option>
                    @endforeach
                    <option value="new">+ Create new group</option>
                </select>
                @error('group')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- New Group (conditionally shown) -->
            <div id="new-group-container" class="hidden">
                <label for="new_group" class="block text-sm font-medium text-textHeading mb-1">New Group Name</label>
                <input type="text" id="new_group" name="new_group" class="input-field w-full" 
                       placeholder="Enter new group name" value="{{ old('new_group') }}">
                @error('new_group')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Guard Name -->
            <div>
                <label for="guard_name" class="block text-sm font-medium text-textHeading mb-1">Guard</label>
                <select id="guard_name" name="guard_name" class="input-field w-full">
                    <option value="web" {{ old('guard_name', 'web') == 'web' ? 'selected' : '' }}>Web</option>
                    <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>API</option>
                </select>
                @error('guard_name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" class="btn-secondary" onclick="hideModal('create-permission-modal')">Cancel</button>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i> Save Permission
            </button>
        </div>
    </form>
    
    <script>
        // Show/hide new group field based on selection
        document.getElementById('group').addEventListener('change', function() {
            const newGroupContainer = document.getElementById('new-group-container');
            if (this.value === 'new') {
                newGroupContainer.classList.remove('hidden');
            } else {
                newGroupContainer.classList.add('hidden');
            }
        });
    </script>
@endcomponent