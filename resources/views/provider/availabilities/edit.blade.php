@extends('provider.layouts.app')

@section('title', 'Edit Availability')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Availability</h1>
            <a href="{{ route('provider.availabilities.index') }}" class="flex items-center text-primary hover:text-primary-light transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Availability
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <form action="{{ route('provider.availabilities.update', $availability->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Service</label>
                        <select id="service_id" name="service_id" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id', $availability->service_id) == $service->id ? 'selected' : '' }}>
                                    {{ $service->title }} ({{ $service->formatted_price }})
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Availability Type</label>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                            <div class="flex items-center">
                                <input type="radio" id="recurring" name="availability_type" value="recurring" class="h-4 w-4 text-primary border-gray-300 focus:ring-primary" {{ $availability->specific_date ? '' : 'checked' }}>
                                <label for="recurring" class="ml-2 text-gray-700 dark:text-gray-300">Recurring Weekly</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="specific" name="availability_type" value="specific" class="h-4 w-4 text-primary border-gray-300 focus:ring-primary" {{ $availability->specific_date ? 'checked' : '' }}>
                                <label for="specific" class="ml-2 text-gray-700 dark:text-gray-300">Specific Date</label>
                            </div>
                        </div>
                    </div>
                    
                    <div id="recurring-fields" class="mb-6" {{ $availability->specific_date ? 'style="display: none;"' : '' }}>
                        <label for="day_of_week" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Day of Week</label>
                        <select id="day_of_week" name="day_of_week" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="1" {{ old('day_of_week', $availability->day_of_week) == 1 ? 'selected' : '' }}>Monday</option>
                            <option value="2" {{ old('day_of_week', $availability->day_of_week) == 2 ? 'selected' : '' }}>Tuesday</option>
                            <option value="3" {{ old('day_of_week', $availability->day_of_week) == 3 ? 'selected' : '' }}>Wednesday</option>
                            <option value="4" {{ old('day_of_week', $availability->day_of_week) == 4 ? 'selected' : '' }}>Thursday</option>
                            <option value="5" {{ old('day_of_week', $availability->day_of_week) == 5 ? 'selected' : '' }}>Friday</option>
                            <option value="6" {{ old('day_of_week', $availability->day_of_week) == 6 ? 'selected' : '' }}>Saturday</option>
                            <option value="0" {{ old('day_of_week', $availability->day_of_week) == 0 ? 'selected' : '' }}>Sunday</option>
                        </select>
                        @error('day_of_week')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div id="specific-fields" class="mb-6" {{ $availability->specific_date ? '' : 'style="display: none;"' }}>
                        <label for="specific_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Specific Date</label>
                        <input type="date" id="specific_date" name="specific_date" min="{{ date('Y-m-d') }}" value="{{ old('specific_date', $availability->specific_date) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        @error('specific_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Time</label>
                            <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $availability->formatted_start_time_input) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Time</label>
                            <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $availability->formatted_end_time_input) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                            @error('end_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_available" value="1" {{ old('is_available', $availability->is_available) ? 'checked' : '' }} class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Available (uncheck to block this time slot)</span>
                        </label>
                    </div>
                    
                    <div id="repeat-until-field" class="mb-6" {{ $availability->specific_date ? 'style="display: none;"' : '' }}>
                        <label for="repeat_until" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Repeat Until (for recurring availability)</label>
                        <input type="date" id="repeat_until" name="repeat_until" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('repeat_until', $availability->repeat_until) }}" class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave empty for indefinite recurring availability</p>
                        @error('repeat_until')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="submit" name="action" value="update_this" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                            Update This Occurrence
                        </button>
                        
                        @if(!$availability->specific_date)
                            <button type="submit" name="action" value="update_all" class="px-4 py-2 bg-secondary text-white rounded-lg hover:bg-opacity-90 transition-all" onclick="return confirm('Are you sure you want to update all future occurrences of this availability?')">
                                Update All Future Occurrences
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const availabilityType = document.querySelectorAll('input[name="availability_type"]');
        const recurringFields = document.getElementById('recurring-fields');
        const specificFields = document.getElementById('specific-fields');
        const repeatUntilField = document.getElementById('repeat-until-field');
        
        // Toggle fields based on availability type
        function toggleFields() {
            if (document.getElementById('recurring').checked) {
                recurringFields.style.display = 'block';
                specificFields.style.display = 'none';
                repeatUntilField.style.display = 'block';
            } else {
                recurringFields.style.display = 'none';
                specificFields.style.display = 'block';
                repeatUntilField.style.display = 'none';
            }
        }
        
        availabilityType.forEach(type => {
            type.addEventListener('change', toggleFields);
        });
        
        // Validate time fields
        const startTimeInput = document.getElementById('start_time');
        const endTimeInput = document.getElementById('end_time');
        
        endTimeInput.addEventListener('change', function() {
            if (startTimeInput.value && endTimeInput.value) {
                if (endTimeInput.value <= startTimeInput.value) {
                    alert('End time must be after start time');
                    endTimeInput.value = '';
                }
            }
        });
    });
</script>
@endpush