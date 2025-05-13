<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Services\AvailabilityService;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    protected $availabilityService;
    protected $serviceService;

    public function __construct(AvailabilityService $availabilityService, ServiceService $serviceService)
    {
        $this->availabilityService = $availabilityService;
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the provider's availabilities.
     */
    public function index(Request $request)
    {
        $serviceId = $request->query('service_id');
        
        // Get all services owned by the provider
        $services = $this->serviceService->getServicesByUser(auth()->id());
        
        // If a specific service is selected, get its availabilities
        $availabilities = collect();
        $selectedService = null;
        
        if ($serviceId) {
            $selectedService = $this->serviceService->getServiceById($serviceId);
            
            // Check if the current provider owns this service
            if ($selectedService->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
            
            $availabilities = $this->availabilityService->getAvailabilitiesByService($serviceId);
        } elseif ($services->isNotEmpty()) {
            // Default to the first service if none is selected
            $selectedService = $services->first();
            $availabilities = $this->availabilityService->getAvailabilitiesByService($selectedService->id);
        }
        
        return view('provider.availabilities.index', compact('services', 'selectedService', 'availabilities'));
    }

    /**
     * Show the form for creating a new availability.
     */
    public function create(Request $request)
    {
        $serviceId = $request->query('service_id');
        
        // Get all services owned by the provider
        $services = $this->serviceService->getServicesByUser(auth()->id());
        
        $selectedService = null;
        
        if ($serviceId) {
            $selectedService = $this->serviceService->getServiceById($serviceId);
            
            // Check if the current provider owns this service
            if ($selectedService->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
        } elseif ($services->isNotEmpty()) {
            // Default to the first service if none is selected
            $selectedService = $services->first();
        }
        
        return view('provider.availabilities.create', compact('services', 'selectedService'));
    }

    /**
     * Store a newly created availability in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        
        // Check if the current provider owns this service
        $service = $this->serviceService->getServiceById($validated['service_id']);
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $this->availabilityService->createAvailability([
                'service_id' => $validated['service_id'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
            
            return redirect()->route('provider.availabilities.index', ['service_id' => $validated['service_id']])
                ->with('success', 'Availability created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while creating the availability: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified availability.
     */
    public function edit(string $id)
    {
        $availability = $this->availabilityService->getAvailabilityById($id);
        
        // Check if the current provider owns the service for this availability
        $service = $this->serviceService->getServiceById($availability->service_id);
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('provider.availabilities.edit', compact('availability', 'service'));
    }

    /**
     * Update the specified availability in storage.
     */
    public function update(Request $request, string $id)
    {
        $availability = $this->availabilityService->getAvailabilityById($id);
        
        // Check if the current provider owns the service for this availability
        $service = $this->serviceService->getServiceById($availability->service_id);
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        
        try {
            $this->availabilityService->updateAvailability($id, [
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
            
            return redirect()->route('provider.availabilities.index', ['service_id' => $availability->service_id])
                ->with('success', 'Availability updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'An error occurred while updating the availability: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified availability from storage.
     */
    public function destroy(string $id)
    {
        $availability = $this->availabilityService->getAvailabilityById($id);
        
        // Check if the current provider owns the service for this availability
        $service = $this->serviceService->getServiceById($availability->service_id);
        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $this->availabilityService->deleteAvailability($id);
            
            return redirect()->route('provider.availabilities.index', ['service_id' => $availability->service_id])
                ->with('success', 'Availability deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the availability: ' . $e->getMessage());
        }
    }

    /**
     * Display the weekly calendar for a service.
     */
    public function calendar(Request $request)
    {
        $serviceId = $request->query('service_id');
        $date = $request->query('date');
        
        // Get all services owned by the provider
        $services = $this->serviceService->getServicesByUser(auth()->id());
        
        $selectedService = null;
        $calendar = null;
        
        if ($serviceId) {
            $selectedService = $this->serviceService->getServiceById($serviceId);
            
            // Check if the current provider owns this service
            if ($selectedService->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
            
            $calendar = $this->availabilityService->getWeeklyCalendar($serviceId, $date);
        } elseif ($services->isNotEmpty()) {
            // Default to the first service if none is selected
            $selectedService = $services->first();
            $calendar = $this->availabilityService->getWeeklyCalendar($selectedService->id, $date);
        }
        
        return view('provider.availabilities.calendar', compact('services', 'selectedService', 'calendar', 'date'));
    }
}
