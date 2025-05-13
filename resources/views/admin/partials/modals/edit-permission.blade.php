@component('admin.components.modal', [
    'id' => 'edit-permission-modal-' . $permission->id,
    'title' => 'Edit Permission: ' . $permission->name,
])
    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="space-y-4">
            <!-- Permission Name -->
            <div>
                <label for="name-{{ $permission->id }}" class="block text-sm font-medium text-textHeading mb-1">Permission Name</label>
                <input type="text" id="name-{{ $permission->id }}" name="name" class="input-field w-full" 
                       placeholder="Enter permission name" value="{{ old('name', $permission->name) }}" required>
                <p class="text-xs text-secondary mt-1">Use format: verb-noun (e.g., create-users, view-reports)</p>
                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Permission Description -->
            <div>
                <label for="description-{{ $permission->id }}" class="block text-sm font-medium text-textHeading mb-1">Description</label>
                <textarea id="description-{{ $permission->id }}" name="description" class="input-field w-full" rows="3" 
                          placeholder="Enter permission description">{{ old('description', $permission->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Permission Group -->
            <div>
                <label for="group-{{ $permission->id }}" class="block text-sm font-medium text-textHeading mb-1">Group</label>
                <select id="group-{{ $permission->id }}" name="group" class="input-field w-full">
                    <option value="">Select a group</option>
                    @foreach($permissionGroups as $group)
                        <option value="{{ $group }}" {{ old('group', $permission->group) == $group ? 'selected' : '' }}>
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
            <div id="new-group-container-{{ $permission->id }}" class="hidden">
                <label for="new_group-{{ $permission->id }}" class="block text-sm font-medium text-textHeading mb-1">New Group Name</label>
                <input type="text" id="new_group-{{ $permission->id }}" name="new_group" class="input-field w-full" 
                       placeholder="Enter new group name" value="{{ old('new_group') }}">
                @error('new_group')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Guard Name -->
            <div>
                <label for="guard_name-{{ $permission->id }}" class="block text-sm font-medium text-textHeading mb-1">Guard</label>
                <select id="guard_name-{{ $permission->id }}" name="guard_name" class="input-field w-full">
                    <option value="web" {{ old('guard_name', $permission->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                    <option value="api" {{ old('guard_name', $permission->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                </select>
                @error('guard_name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" class="btn-secondary" onclick="hideModal('edit-permission-modal-{{ $permission->id }}')">Cancel</button>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i> Update Permission
            </button>
        </div>
    </form>
    
    <script>
        // Show/hide new group field based on selection
        document.getElementById('group-{{ $permission->id }}').addEventListener('change', function() {
            const newGroupContainer = document.getElementById('new-group-container-{{ $permission->id }}');
            if (this.value === 'new') {
                newGroupContainer.classList.remove('hidden');
            } else {
                newGroupContainer.classList.add('hidden');
            }
        });
    </script>
@endcomponent