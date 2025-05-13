@extends('provider.layouts.app')

@section('title', 'Manage Bookings')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Manage Bookings</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Booking Status Filter -->
    <div class="mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
            <div class="flex flex-wrap items-center">
                <span class="text-gray-700 dark:text-gray-300 font-medium mr-4 mb-2 sm:mb-0">Filter by Status:</span>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('provider.bookings.index') }}" class="px-4 py-2 rounded-full text-sm {{ request()->query('status') === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        All
                    </a>
                    <a href="{{ route('provider.bookings.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-full text-sm {{ request()->query('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Pending
                    </a>
                    <a href="{{ route('provider.bookings.index', ['status' => 'confirmed']) }}" class="px-4 py-2 rounded-full text-sm {{ request()->query('status') === 'confirmed' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Confirmed
                    </a>
                    <a href="{{ route('provider.bookings.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-full text-sm {{ request()->query('status') === 'completed' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Completed
                    </a>
                    <a href="{{ route('provider.bookings.index', ['status' => 'cancelled']) }}" class="px-4 py-2 rounded-full text-sm {{ request()->query('status') === 'cancelled' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Cancelled
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    @if($bookings->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-10 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="h-24 w-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-alt text-4xl text-gray-400 dark:text-gray-500"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No Bookings Found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    @if(request()->has('status'))
                        There are no {{ request()->query('status') }} bookings at the moment.
                    @else
                        You don't have any bookings yet.
                    @endif
                </p>
                <a href="{{ route('provider.availabilities.index') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                    Manage Availability
                </a>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Client
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Date & Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                            <i class="fas fa-concierge-bell text-gray-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $booking->service->title }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $booking->service->formatted_price }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $booking->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $booking->user->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $booking->booking_date->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $booking->booking_date->format('h:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100',
                                            'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
                                            'completed' => 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100',
                                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100',
                                        ];
                                        $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('provider.bookings.show', $booking->id) }}" class="text-primary hover:text-primary-light">
                                            View
                                        </a>
                                        
                                        @if($booking->status == 'pending')
                                            <form action="{{ route('provider.bookings.confirm', $booking->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-800">
                                                    Confirm
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($booking->status == 'confirmed')
                                            <form action="{{ route('provider.bookings.complete', $booking->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-800" onclick="return confirm('Are you sure you want to mark this booking as completed?')">
                                                    Complete
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($booking->status == 'pending' || $booking->status == 'confirmed')
                                            <form action="{{ route('provider.bookings.cancel', $booking->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="{{ route('messages.conversation', $booking->user_id) }}" class="text-secondary hover:text-secondary-light">
                                            Message
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $bookings->links() }}
            </div>
        </div>
    @endif

    <!-- Calendar Preview -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Calendar Preview</h2>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
            <div class="flex justify-between items-center mb-4">
                <button id="prev-month" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-chevron-left text-gray-600 dark:text-gray-400"></i>
                </button>
                <h3 id="current-month" class="text-lg font-medium text-gray-900 dark:text-white"></h3>
                <button id="next-month" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-chevron-right text-gray-600 dark:text-gray-400"></i>
                </button>
            </div>
            
            <div class="grid grid-cols-7 gap-1 mb-2 text-center">
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Sun</div>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Mon</div>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Tue</div>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Wed</div>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Thu</div>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Fri</div>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Sat</div>
            </div>
            
            <div id="calendar-grid" class="grid grid-cols-7 gap-1">
                <!-- Calendar days will be inserted here by JavaScript -->
            </div>
            
            <div class="mt-4 flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-4">
                <div class="flex flex-wrap gap-2">
                    <div class="flex items-center">
                        <div class="h-3 w-3 bg-yellow-400 rounded-full mr-1"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400">Pending</span>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 bg-green-500 rounded-full mr-1"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400">Confirmed</span>
                    </div>
                    <div class="flex items-center">
                        <div class="h-3 w-3 bg-blue-500 rounded-full mr-1"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-400">Completed</span>
                    </div>
                </div>
                
                <a href="{{ route('provider.availabilities.calendar') }}" class="text-primary hover:text-primary-light text-sm">
                    View Full Calendar <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookings = @json($calendarBookings ?? []);
        const calendarGrid = document.getElementById('calendar-grid');
        const currentMonthElement = document.getElementById('current-month');
        const prevMonthButton = document.getElementById('prev-month');
        const nextMonthButton = document.getElementById('next-month');
        
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        
        // Render calendar with current month
        renderCalendar(currentYear, currentMonth);
        
        // Event listeners for month navigation
        prevMonthButton.addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentYear, currentMonth);
        });
        
        nextMonthButton.addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentYear, currentMonth);
        });
        
        function renderCalendar(year, month) {
            // Clear grid
            calendarGrid.innerHTML = '';
            
            // Set current month display
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            currentMonthElement.textContent = `${monthNames[month]} ${year}`;
            
            // Get first day of month and total days
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            // Add empty cells for days before the first of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'h-14 bg-gray-50 dark:bg-gray-700 rounded-md opacity-50';
                calendarGrid.appendChild(emptyCell);
            }
            
            // Add cells for each day of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const cell = document.createElement('div');
                cell.className = 'h-14 bg-gray-50 dark:bg-gray-700 rounded-md p-1 relative';
                
                // Check if it's today
                const isToday = year === new Date().getFullYear() && month === new Date().getMonth() && day === new Date().getDate();
                if (isToday) {
                    cell.classList.add('border-2', 'border-primary');
                }
                
                // Add day number
                const dayNumber = document.createElement('div');
                dayNumber.className = 'text-xs font-medium text-gray-700 dark:text-gray-300';
                dayNumber.textContent = day;
                cell.appendChild(dayNumber);
                
                // Check for bookings on this day
                const currentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayBookings = bookings.filter(booking => booking.date === currentDate);
                
                if (dayBookings.length > 0) {
                    // Group bookings by status
                    const statusCount = {
                        pending: 0,
                        confirmed: 0,
                        completed: 0,
                        cancelled: 0
                    };
                    
                    dayBookings.forEach(booking => {
                        statusCount[booking.status]++;
                    });
                    
                    // Add indicators for bookings
                    const indicators = document.createElement('div');
                    indicators.className = 'absolute bottom-1 left-1 right-1 flex justify-center gap-1';
                    
                    if (statusCount.pending > 0) {
                        const pendingIndicator = document.createElement('div');
                        pendingIndicator.className = 'h-2 w-2 bg-yellow-400 rounded-full';
                        pendingIndicator.setAttribute('title', `${statusCount.pending} pending bookings`);
                        indicators.appendChild(pendingIndicator);
                    }
                    
                    if (statusCount.confirmed > 0) {
                        const confirmedIndicator = document.createElement('div');
                        confirmedIndicator.className = 'h-2 w-2 bg-green-500 rounded-full';
                        confirmedIndicator.setAttribute('title', `${statusCount.confirmed} confirmed bookings`);
                        indicators.appendChild(confirmedIndicator);
                    }
                    
                    if (statusCount.completed > 0) {
                        const completedIndicator = document.createElement('div');
                        completedIndicator.className = 'h-2 w-2 bg-blue-500 rounded-full';
                        completedIndicator.setAttribute('title', `${statusCount.completed} completed bookings`);
                        indicators.appendChild(completedIndicator);
                    }
                    
                    cell.appendChild(indicators);
                    
                    // Make cell clickable to view bookings for that day
                    cell.classList.add('cursor-pointer', 'hover:bg-gray-100', 'dark:hover:bg-gray-600');
                    cell.addEventListener('click', function() {
                        window.location.href = `{{ route('provider.bookings.index') }}?date=${currentDate}`;
                    });
                }
                
                calendarGrid.appendChild(cell);
            }
        }
    });
</script>
@endpush