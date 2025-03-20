@if (session('success') || session('error') || session('warning') || session('info'))
    <div id="flash-message" class="mb-6 transition-opacity duration-300">
        @if (session('success'))
            <div class="bg-tertiary bg-opacity-20 border-l-4 border-tertiary text-textHeading p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-tertiary mr-3 text-xl"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 bg-opacity-20 border-l-4 border-red-500 text-textHeading p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-500 bg-opacity-20 border-l-4 border-yellow-500 text-textHeading p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-3 text-xl"></i>
                    <p>{{ session('warning') }}</p>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-blue-500 bg-opacity-20 border-l-4 border-blue-500 text-textHeading p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-3 text-xl"></i>
                    <p>{{ session('info') }}</p>
                </div>
            </div>
        @endif
    </div>
@endif