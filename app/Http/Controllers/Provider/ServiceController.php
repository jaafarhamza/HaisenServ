<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    protected $serviceService;
    protected $categoryRepository;

    public function __construct(
        ServiceService $serviceService,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->serviceService = $serviceService;
        $this->categoryRepository = $categoryRepository;
    }

    public function create()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $user = Auth::user();
        
        // Get user's associated categories (if any)
        $userCategories = $user->categories->pluck('id')->toArray();
        
        return view('provider.services.create', compact('categories', 'userCategories'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required|string|max:255',
        ]);
        
        $validated['user_id'] = $user->id;
        $validated['status'] = 'pending'; 
        
        if (!isset($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title'];
        }
        
        if (!isset($validated['meta_description'])) {
            $validated['meta_description'] = Str::limit($validated['description'], 160);
        }
        
        try {
            $service = $this->serviceService->createService($validated);
            
            return redirect()->route('homepage')
                ->with('success', 'Your service has been created and is awaiting approval.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create service: ' . $e->getMessage())
                ->withInput();
        }
    }
}