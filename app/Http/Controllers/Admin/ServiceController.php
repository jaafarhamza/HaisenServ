<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Services\ServiceService;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    protected $serviceService;
    protected $categoryService;

    public function __construct(
        ServiceService $serviceService,
        CategoryService $categoryService
    ) {
        $this->serviceService = $serviceService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'user_id', 'status', 'sort_by', 'sort_order', 'city']);
        $services = $this->serviceService->getPaginatedServices($filters);
        $categories = $this->serviceService->getAllCategories();
        $statuses = $this->serviceService->getServiceStatuses();

        $cities = \App\Models\Service::select('city')
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city')
            ->toArray();

        return view('admin.services.index', compact('services', 'categories', 'statuses', 'filters', 'cities'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllMainCategories();
        $statuses = $this->serviceService->getServiceStatuses();

        return view('admin.services.create', compact('categories', 'statuses'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => [
                'required',
                Rule::in(array_keys($this->serviceService->getServiceStatuses())),
            ],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image_url' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        try {
            $this->serviceService->createService($validated);

            return redirect()->route('admin.services.index')
                ->with('success', 'Service created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create service: ' . $e->getMessage())
                ->withInput();
        }
    }
    public function show(Service $service)
    {
        $service->load('user', 'category');

        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $categories = $this->categoryService->getAllMainCategories();
        $statuses = $this->serviceService->getServiceStatuses();

        return view('admin.services.edit', compact('service', 'categories', 'statuses'));
    }


    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => [
                'required',
                Rule::in(array_keys($this->serviceService->getServiceStatuses())),
            ],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image_url' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        try {
            $this->serviceService->updateService($service, $validated);

            return redirect()->route('admin.services.index')
                ->with('success', 'Service updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update service: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Service $service)
    {
        try {
            $this->serviceService->deleteService($service);
            return redirect()->route('admin.services.index')
                ->with('success', 'Service deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function changeStatus(Request $request, Service $service)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(array_keys($this->serviceService->getServiceStatuses())),
            ],
        ]);

        try {
            $this->serviceService->updateService($service, $validated);

            return redirect()->back()
                ->with('success', 'Service status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update service status: ' . $e->getMessage());
        }
    }
}