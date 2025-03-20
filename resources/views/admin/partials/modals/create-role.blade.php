@component('admin.components.modal', [
    'id' => 'create-role-modal',
    'title' => 'Add New Role',
    'width' => 'max-w-2xl'
])
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        
        <div class="space-y-4">
            <!-- Role Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-textHeading mb-1">Role Name</label>
                <input type="text" id="name" name="name" class="input-field w-full" 
                       placeholder="Enter role name" value="{{ old('name') }}" required>
                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Role Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-textHeading mb-1">Description</label>
                <textarea id="description" name="description" class="input-field w-full" rows="3" 
                          placeholder="Enter role description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Permissions -->
            <div>
                <label class="block text-sm font-medium text-textHeading mb-2">Permissions</label>
                <div class="bg-bgPrimary rounded-lg p-4 max-h-60 overflow-y-auto">
                    @foreach($permissionGroups as $groupName => $permissions)
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-highlight mb-2">{{ $groupName }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 ml-2">
                                @foreach($permissions as $permission)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="permission-{{ $permission->id }}" 
                                               name="permissions[]" value="{{ $permission->id }}"
                                               class="mr-2 rounded bg-bgSecondary border-secondary text-highlight focus:ring-highlight"
                                               {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                        <label for="permission-{{ $permission->id }}" class="text-sm">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('permissions')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
            <button type="button" class="btn-secondary" onclick="hideModal('create-role-modal')">Cancel</button>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i> Save Role
            </button>
        </div>
    </form>
@endcomponent