<div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-6 mb-6">
    @foreach($stats as $stat)
    <div class="card p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-secondary">{{ $stat['title'] }}</p>
                <h3 class="text-3xl font-bold text-textHeading">{{ $stat['value'] }}</h3>
            </div>
            <div class="h-12 w-12 rounded-lg bg-{{ $stat['color'] }} bg-opacity-20 flex items-center justify-center">
                <i class="fas fa-{{ $stat['icon'] }} text-{{ $stat['color'] }} text-xl"></i>
            </div>
        </div>
        @if(isset($stat['change']))
            <div class="mt-4 flex items-center {{ $stat['change'] > 0 ? 'text-tertiary' : 'text-red-500' }}">
                <i class="fas fa-arrow-{{ $stat['change'] > 0 ? 'up' : 'down' }} mr-1"></i>
                <span class="text-sm">{{ abs($stat['change']) }}{{ $stat['change_type'] ?? '%' }} from last {{ $stat['period'] ?? 'month' }}</span>
            </div>
        @endif
    </div>
    @endforeach
</div>