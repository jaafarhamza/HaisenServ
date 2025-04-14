<?php

namespace App\Http\Controllers\Provider;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class ProfileController extends Controller
{
    protected $userRepository;
    protected $CategoryRepository;

    public function __construct(UserRepositoryInterface $userRepository,CategoryRepositoryInterface $categoryRepository)
    {
        $this->userRepository = $userRepository;
        $this->CategoryRepository= $categoryRepository;
    }

    public function showProfile()
    {
        $user = Auth::user();
        
        if (!$user->hasRole('provider')) {
            return redirect()->route('role.selection')
                ->with('error', 'You must select a role first.');
        }
        
        $categories = $this->CategoryRepository->getAllCategories();
        $selectedCategories = $user->categories()->pluck('id')->toArray();
        return view('provider.profile', compact('user', 'categories', 'selectedCategories'));
    }
    
    public function showNextSteps()
    {
        $user = Auth::user();
        
        if (!$user->hasRole('provider')) {
            return redirect()->route('role.selection')
                ->with('error', 'You must select a role first.');
        }
        
        return view('provider.next-steps', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_contains($user->avatar, 'google')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->avatar));
            }
            
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = '/storage/' . $path;
        }
 
        $validated['profile_completed'] = true;
        
        $this->userRepository->updateUser($user, $validated);
        $categoryIds = isset($validated['categories']) ? $validated['categories'] : [];

        if (isset($validated['categories'])) {
            $user->categories()->sync($validated['categories']);
        }
        
         // Handle new categories
         if (!empty($request->new_categories)) {
            $newCategoryNames = array_map('trim', explode(',', $request->new_categories));
            
            foreach ($newCategoryNames as $categoryName) {
                if (!empty($categoryName)) {
                    // Check if category already exists
                    $existingCategory = Category::where('name', $categoryName)->first();
                    
                    if ($existingCategory) {
                        $categoryIds[] = $existingCategory->id;
                    } else {
                        // Create new category
                        $newCategory = Category::create([
                            'name' => $categoryName,
                            'slug' => \Illuminate\Support\Str::slug($categoryName),
                        ]);
                        $categoryIds[] = $newCategory->id;
                    }
                }
            }
        }
        $user->categories()->sync($categoryIds);
        return redirect()->route('provider.next-steps')
            ->with('success', 'Your profile has been updated successfully.');
    }
}