<div id="{{ $id }}" class="fixed inset-0 bg-black bg-opacity-50 z-20 flex items-center justify-center {{ isset($show) && $show ? '' : 'hidden' }}">
    <div class="bg-bgSecondary rounded-xl shadow-2xl w-full {{ $width ?? 'max-w-md' }} p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-textHeading">{{ $title }}</h3>
            <button type="button" class="text-secondary hover:text-textHeading" 
                onclick="hideModal('{{ $id }}')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>