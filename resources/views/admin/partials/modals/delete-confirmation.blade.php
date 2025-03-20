@component('admin.components.modal', [
    'id' => 'delete-' . $model . '-modal-' . $id,
    'title' => 'Delete Confirmation',
])
    <div class="text-center">
        <div class="mb-5">
            <div class="h-20 w-20 bg-red-500 bg-opacity-20 text-red-500 rounded-full mx-auto flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-3xl"></i>
            </div>
        </div>
        
        <h3 class="text-xl font-bold text-textHeading mb-2">Are you sure?</h3>
        <p class="text-textParagraph mb-6">
            You are about to delete {{ $name }}. This action cannot be undone.
            @if(isset($warning))
                <br><span class="text-red-500 mt-2 block">{{ $warning }}</span>
            @endif
        </p>
        
        <div class="flex justify-center space-x-4">
            <button type="button" class="btn-secondary" 
                onclick="hideModal('delete-{{ $model }}-modal-{{ $id }}')">
                Cancel
            </button>
            
            <form action="{{ $route }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endcomponent