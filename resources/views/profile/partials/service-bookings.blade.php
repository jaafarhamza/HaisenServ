<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Service Bookings</h2>
    
    <div class="mb-6">
        <div class="flex space-x-2">
            <a href="{{ route('profile.index', ['tab' => 'service-bookings', 'status' => 'all']) }}" 
                class="px-4 py-2 {{ !request('status') || request('status') === 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }} rounded-lg">
                All
            </a>
            <a href="{{ route('profile.index', ['tab' => 'service-bookings', 'status' => 'pending']) }}" 
                class="px-4 py-2 {{ request('status') === 'pending' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }} rounded-lg">
                Pending
            </a>
            <a href="{{ route('profile.index', ['tab' => 'service-bookings', 'status' => 'confirmed']) }}" 
                class="px-4 py-2 {{ request('status') === 'confirmed' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }} rounded-lg">
                Confirmed
            </a>
            <a href="{{ route('profile.index', ['tab' => 'service-bookings', 'status' => 'completed']) }}" 
                class="px-4 py-2 {{ request('status') === 'completed' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }} rounded-lg">
                Completed
            </a>
            <a href="{{ route('profile.index', ['tab' => 'service-bookings', 'status' => 'cancelled']) }}" 
                class="px-4 py-2 {{ request('status') === 'cancelled' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }} rounded-lg">
                Cancelled
            </a>
        </div>
    </div>
    
    @if(isset($serviceBookings) && $serviceBookings->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Service
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Date & Time
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach($serviceBookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $booking->service->title }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $booking->service->category->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" 
                                            src="{{ $booking->user->avatar ? asset('storage/' . $booking->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($booking->user->name) . '&background=random' }}" 
                                            alt="{{ $booking->user->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $booking->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $booking->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $booking->booking_date->format('M j, Y') }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $booking->booking_date->format('g:i A') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->status === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                        Pending
                                    </span>
                                @elseif($booking->status === 'confirmed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                        Confirmed
                                    </span>
                                @elseif($booking->status === 'completed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                        Completed
                                    </span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('profile.confirmBooking', $booking->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                Confirm
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('profile.cancelBooking', $booking->id) }}" method="POST" class="inline-block ml-3">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" 
                                                onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                Cancel
                                            </button>
                                        </form>
                                    @elseif($booking->status === 'confirmed')
                                        <form action="{{ route('profile.completeBooking', $booking->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Mark as Completed
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('profile.cancelBooking', $booking->id) }}" method="POST" class="inline-block ml-3">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" 
                                                onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('messages.create', ['recipient_id' => $booking->user_id]) }}" class="text-primary hover:text-primary-light ml-3">
                                        Message
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-center">
            <i class="fas fa-calendar-times text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Bookings Found</h3>
            <p class="text-gray-600 dark:text-gray-400">You don't have any bookings for your services yet.</p>
        </div>
    @endif
</div>