@extends('provider.layouts.app')

@section('title', 'Availability Calendar')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Availability Calendar</h1>
        <a href="{{ route('provider.availabilities.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
            <i class="fas fa-plus mr-2"></i> Add Availability
        </a>
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

    <!-- Quick Navigation -->
    <div class="mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
            <div class="flex items-center justify-between flex-wrap">
                <div class="flex items-center mb-3 sm:mb-0">
                    <span class="text-gray-700 dark:text-gray-300 font-medium mr-4">View:</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('provider.availabilities.index') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('provider.availabilities.index') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                            List View
                        </a>
                        <a href="{{ route('provider.availabilities.calendar') }}" class="px-4 py-2 rounded-lg {{ request()->routeIs('provider.availabilities.calendar') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                            Calendar View
                        </a>
                    </div>
                </div>
                <div>
                    <a href="{{ route('provider.bookings.index') }}" class="text-primary hover:text-primary-light">
                        <i class="fas fa-calendar-check mr-1"></i> View Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Filter -->
    @if(count($services) > 1)
        <div class="mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                <form action="{{ route('provider.availabilities.calendar') }}" method="GET" class="flex flex-wrap items-center">
                    <span class="text-gray-700 dark:text-gray-300 font-medium mr-4 mb-2 sm:mb-0">Filter by Service:</span>
                    <select name="service_id" class="px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 mr-2">
                        <option value="">All Services</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->title }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                        Apply Filter
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Calendar View -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-8">
        <div class="p-6">
            <!-- Calendar Header -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <button id="prev-month" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-chevron-left text-gray-600 dark:text-gray-400"></i>
                    </button>
                    <h2 id="current-month-year" class="text-xl font-semibold text-gray-900 dark:text-white mx-4"></h2>
                    <button id="next-month" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-chevron-right text-gray-600 dark:text-gray-400"></i>
                    </button>
                </div>
                <button id="today-btn" class="px-4 py-2 bg-primary text-white text-sm rounded-lg hover:bg-opacity-90 transition-all">
                    Today
                </button>
            </div>
            
            <!-- Calendar Grid -->
            <div>
                <div class="grid grid-cols-7 gap-1 mb-2 text-center">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 p-2">Sun</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 p-2">Mon</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 p-2">Tue</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 p-2">Wed</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 p-2">Thu</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 p-2">Fri</div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 p-2">Sat</div>
                </div>
                
                <div id="calendar-grid" class="grid grid-cols-7 gap-1">
                    <!-- Calendar days will be inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Legend -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-8">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Legend</h3>
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center">
                <div class="h-4 w-4 bg-green-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600 dark:text-gray-400">Available</span>
            </div>
            <div class="flex items-center">
                <div class="h-4 w-4 bg-red-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600 dark:text-gray-400">Blocked</span>
            </div>
            <div class="flex items-center">
                <div class="h-4 w-4 bg-yellow-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600 dark:text-gray-400">Pending Booking</span>
            </div>
            <div class="flex items-center">
                <div class="h-4 w-4 bg-blue-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600 dark:text-gray-400">Confirmed Booking</span>
            </div>
            <div class="flex items-center">
                <div class="h-4 w-4 bg-purple-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600 dark:text-gray-400">Completed Booking</span>
            </div>
        </div>
    </div>
    
    <!-- Event Details Modal -->
    <div id="event-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-start mb-4">
                <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div id="modal-content" class="mb-6">
                <!-- Content will be dynamically inserted -->
            </div>
            
            <div id="modal-actions" class="flex justify-end space-x-2">
                <!-- Actions will be dynamically inserted -->
                <button id="modal-close-btn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Calendar state
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        
        // Calendar data
        const availabilities = @json($availabilities);
        const bookings = @json($bookings);
        
        // DOM elements
        const calendarGrid = document.getElementById('calendar-grid');
        const currentMonthYearElement = document.getElementById('current-month-year');
        const prevMonthButton = document.getElementById('prev-month');
        const nextMonthButton = document.getElementById('next-month');
        const todayButton = document.getElementById('today-btn');
        
        // Modal elements
        const eventModal = document.getElementById('event-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalContent = document.getElementById('modal-content');
        const modalActions = document.getElementById('modal-actions');
        const closeModalButton = document.getElementById('close-modal');
        const modalCloseBtn = document.getElementById('modal-close-btn');
        
        // Initialize calendar
        renderCalendar();
        
        // Event listeners
        prevMonthButton.addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        });
        
        nextMonthButton.addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        });
        
        todayButton.addEventListener('click', function() {
            currentMonth = new Date().getMonth();
            currentYear = new Date().getFullYear();
            renderCalendar();
        });
        
        closeModalButton.addEventListener('click', closeModal);
        modalCloseBtn.addEventListener('click', closeModal);
        eventModal.addEventListener('click', function(e) {
            if (e.target === eventModal) {
                closeModal();
            }
        });
        
        // Render calendar
        function renderCalendar() {
            // Set current month/year display
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            currentMonthYearElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            
            // Clear grid
            calendarGrid.innerHTML = '';
            
            // Get first day of month and total days
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            
            // Add empty cells for days before the first of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'h-32 bg-gray-50 dark:bg-gray-700 rounded-md opacity-50';
                calendarGrid.appendChild(emptyCell);
            }
            
            // Add cells for each day of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const cell = document.createElement('div');
                cell.className = 'min-h-32 bg-gray-50 dark:bg-gray-700 rounded-md p-1 relative';
                
                // Check if it's today
                const isToday = day === new Date().getDate() && 
                                currentMonth === new Date().getMonth() && 
                                currentYear === new Date().getFullYear();
                
                if (isToday) {
                    cell.classList.add('border-2', 'border-primary');
                }
                
                // Add day number
                const dayNumber = document.createElement('div');
                dayNumber.className = 'text-sm font-medium text-gray-700 dark:text-gray-300 p-1';
                dayNumber.textContent = day;
                cell.appendChild(dayNumber);
                
                // Add events container
                const eventsContainer = document.createElement('div');
                eventsContainer.className = 'mt-1 space-y-1 max-h-24 overflow-auto';
                
                // Format date string for comparison
                const dateString = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                
                // Add availabilities for this day
                const dayAvailabilities = availabilities.filter(a => {
                    if (a.specific_date) {
                        return a.specific_date === dateString;
                    } else {
                        // For recurring availabilities, check if day of week matches
                        const currentDayOfWeek = new Date(currentYear, currentMonth, day).getDay();
                        return a.day_of_week === currentDayOfWeek;
                    }
                });
                
                // Add bookings for this day
                const dayBookings = bookings.filter(b => {
                    return b.date === dateString;
                });
                
                // Add availability items
                dayAvailabilities.forEach(availability => {
                    const availabilityItem = document.createElement('div');
                    availabilityItem.className = `text-xs p-1 rounded truncate ${availability.is_available ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:bg-opacity-50 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:bg-opacity-50 dark:text-red-200'}`;
                    availabilityItem.textContent = `${availability.formatted_start_time} - ${availability.formatted_end_time}`;
                    availabilityItem.dataset.id = availability.id;
                    availabilityItem.dataset.type = 'availability';
                    availabilityItem.addEventListener('click', () => showAvailabilityDetails(availability));
                    eventsContainer.appendChild(availabilityItem);
                });
                
                // Add booking items
                dayBookings.forEach(booking => {
                    const bookingItem = document.createElement('div');
                    
                    let statusClass = '';
                    if (booking.status === 'pending') {
                        statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:bg-opacity-50 dark:text-yellow-200';
                    } else if (booking.status === 'confirmed') {
                        statusClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:bg-opacity-50 dark:text-blue-200';
                    } else if (booking.status === 'completed') {
                        statusClass = 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:bg-opacity-50 dark:text-purple-200';
                    } else {
                        statusClass = 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:bg-opacity-50 dark:text-gray-200';
                    }
                    
                    bookingItem.className = `text-xs p-1 rounded truncate ${statusClass}`;
                    bookingItem.textContent = `${booking.time} - ${booking.client_name}`;
                    bookingItem.dataset.id = booking.id;
                    bookingItem.dataset.type = 'booking';
                    bookingItem.addEventListener('click', () => showBookingDetails(booking));
                    eventsContainer.appendChild(bookingItem);
                });
                
                // Add "Add" button if empty and is future date
                if (dayAvailabilities.length === 0 && isDateInFuture(currentYear, currentMonth, day)) {
                    const addButton = document.createElement('div');
                    addButton.className = 'text-xs p-1 rounded text-center text-primary hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer';
                    addButton.innerHTML = '<i class="fas fa-plus mr-1"></i> Add';
                    addButton.addEventListener('click', () => addAvailabilityForDate(dateString));
                    eventsContainer.appendChild(addButton);
                }
                
                cell.appendChild(eventsContainer);
                calendarGrid.appendChild(cell);
            }
        }
        
        // Check if date is in future
        function isDateInFuture(year, month, day) {
            const checkDate = new Date(year, month, day);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return checkDate >= today;
        }
        
        // Show availability details
        function showAvailabilityDetails(availability) {
            modalTitle.textContent = `Availability: ${availability.service_name}`;
            
            let content = `
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Time</p>
                        <p class="text-gray-900 dark:text-white font-medium">${availability.formatted_start_time} - ${availability.formatted_end_time}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                        <p class="text-gray-900 dark:text-white font-medium">
                            <span class="px-2 py-1 rounded-full text-xs ${availability.is_available ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:bg-opacity-50 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:bg-opacity-50 dark:text-red-200'}">
                                ${availability.is_available ? 'Available' : 'Blocked'}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Type</p>
                        <p class="text-gray-900 dark:text-white font-medium">${availability.specific_date ? 'Specific Date' : 'Recurring Weekly'}</p>
                    </div>
                    ${availability.specific_date ? 
                        `<div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Date</p>
                            <p class="text-gray-900 dark:text-white font-medium">${availability.specific_date}</p>
                        </div>` : 
                        `<div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Day of Week</p>
                            <p class="text-gray-900 dark:text-white font-medium">${availability.day_of_week_name}</p>
                        </div>`
                    }
                </div>
            `;
            
            modalContent.innerHTML = content;
            
            // Add actions
            modalActions.innerHTML = `
                <a href="{{ route('provider.availabilities.edit', '') }}/${availability.id}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all mr-2">
                    Edit
                </a>
                <form action="{{ route('provider.availabilities.destroy', '') }}/${availability.id}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-opacity-90 transition-all mr-2" onclick="return confirm('Are you sure you want to delete this availability?')">
                        Delete
                    </button>
                </form>
                <button id="modal-close-btn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Close
                </button>
            `;
            
            // Add event listener to the new close button
            document.getElementById('modal-close-btn').addEventListener('click', closeModal);
            
            // Show modal
            eventModal.classList.remove('hidden');
        }
        
        // Show booking details
        function showBookingDetails(booking) {
            modalTitle.textContent = `Booking: ${booking.service_name}`;
            
            let statusClass = '';
            if (booking.status === 'pending') {
                statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:bg-opacity-50 dark:text-yellow-200';
            } else if (booking.status === 'confirmed') {
                statusClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:bg-opacity-50 dark:text-blue-200';
            } else if (booking.status === 'completed') {
                statusClass = 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:bg-opacity-50 dark:text-purple-200';
            } else {
                statusClass = 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:bg-opacity-50 dark:text-gray-200';
            }
            
            let content = `
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Client</p>
                        <p class="text-gray-900 dark:text-white font-medium">${booking.client_name}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Date & Time</p>
                        <p class="text-gray-900 dark:text-white font-medium">${booking.date} at ${booking.time}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                        <p class="text-gray-900 dark:text-white font-medium">
                            <span class="px-2 py-1 rounded-full text-xs ${statusClass}">
                                ${booking.status.charAt(0).toUpperCase() + booking.status.slice(1)}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Notes</p>
                        <p class="text-gray-900 dark:text-white font-medium">${booking.notes || 'No notes provided'}</p>
                    </div>
                </div>
            `;
            
            modalContent.innerHTML = content;
            
            // Add actions
            modalActions.innerHTML = `
                <a href="{{ route('provider.bookings.show', '') }}/${booking.id}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all mr-2">
                    View Details
                </a>
                <button id="modal-close-btn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Close
                </button>
            `;
            
            // Add event listener to the new close button
            document.getElementById('modal-close-btn').addEventListener('click', closeModal);
            
            // Show modal
            eventModal.classList.remove('hidden');
        }
        
        // Add availability for a specific date
        function addAvailabilityForDate(date) {
            // Redirect to create availability page with date pre-filled
            window.location.href = `{{ route('provider.availabilities.create') }}?specific_date=${date}&availability_type=specific`;
        }
        
        // Close modal
        function closeModal() {
            eventModal.classList.add('hidden');
        }
    });
</script>
@endpush