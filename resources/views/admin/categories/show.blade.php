@extends('admin.layouts.app')

@section('title', 'Category Details')
@section('header-title', 'Category Details')

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-folder-open mr-2 text-highlight"></i> Category: {{ $category->name }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-primary">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Categories
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Category Details -->
        <div class="lg:col-span-2">
            <div class="card p-6">
                <h3 class="text-xl font-bold text-textHeading mb-4">Category Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Name</h4>
                        <p class="text-textHeading">{{ $category->name }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Slug</h4>
                        <p class="text-textHeading font-mono">{{ $category->slug }}</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <h4 class="text-sm font-medium text-secondary mb-1">Description</h4>
                        <p class="text-textHeading">{{ $category->description ?? 'No description provided' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Parent Category</h4>
                        @if($category->parent)
                            <a href="{{ route('admin.categories.show', $category->parent_id) }}" class="text-highlight hover:underline">
                                {{ $category->parent->name }}
                            </a>
                        @else
                            <span class="badge badge-primary">Main Category</span>
                        @endif
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Created At</h4>
                        <p class="text-textHeading">{{ $category->created_at->format('F j, Y, g:i a') }}</p>
                    </div>
                </div>
                
                <hr class="my-6 border-secondary">
                
                <h3 class="text-xl font-bold text-textHeading mb-4">SEO Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Meta Title</h4>
                        <p class="text-textHeading">{{ $category->meta_title ?? $category->name }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Meta Keywords</h4>
                        <p class="text-textHeading">{{ $category->meta_keywords ?? 'None' }}</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <h4 class="text-sm font-medium text-secondary mb-1">Meta Description</h4>
                        <p class="text-textHeading">{{ $category->meta_description ?? 'None' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Canonical URL</h4>
                        <p class="text-textHeading font-mono">{{ $category->canonical_url ?? 'Auto-generated' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-secondary mb-1">Robots Directive</h4>
                        <span class="badge {{ $category->robots == 'index,follow' ? 'badge-success' : 'badge-warning' }}">
                            {{ $category->robots ?? 'index,follow' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div>
            <!-- Statistics -->
            <div class="card p-6 mb-6">
                <h3 class="text-lg font-bold text-textHeading mb-4">Statistics</h3>
                
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="text-sm font-medium text-secondary">Services</h4>
                            <span class="badge badge-primary">{{ $category->services->count() }}</span>
                        </div>
                        <div class="h-2 bg-bgPrimary rounded-full">
                            <div class="h-full bg-highlight rounded-full" style="width: {{ min($category->services->count() * 5, 100) }}%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="text-sm font-medium text-secondary">Subcategories</h4>
                            <span class="badge badge-primary">{{ $category->subcategories->count() }}</span>
                        </div>
                        <div class="h-2 bg-bgPrimary rounded-full">
                            <div class="h-full bg-tertiary rounded-full" style="width: {{ min($category->subcategories->count() * 10, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="card p-6">
                <h3 class="text-lg font-bold text-textHeading mb-4">Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-primary w-full flex items-center justify-center">
                        <i class="fas fa-edit mr-2"></i> Edit Category
                    </a>
                    
                    @if($category->services->count() == 0)
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger w-full" 
                                onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fas fa-trash mr-2"></i> Delete Category
                            </button>
                        </form>
                    @else
                        <button type="button" class="btn-danger w-full opacity-50 cursor-not-allowed" 
                            title="Cannot delete category with services">
                            <i class="fas fa-trash mr-2"></i> Delete Category
                        </button>
                        <p class="text-xs text-red-500">Categories with services cannot be deleted.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Subcategories -->
    @if($category->subcategories->count() > 0)
        <div class="card mt-6">
            <div class="p-6 border-b border-secondary">
                <h3 class="text-xl font-bold text-textHeading">Subcategories</h3>
            </div>
            
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-secondary">
                        <thead class="bg-bgPrimary">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Services</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-textHeading uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary">
                            @foreach($category->subcategories as $subcategory)
                                <tr class="hover:bg-bgPrimary transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 rounded bg-bgPrimary flex items-center justify-center text-highlight">
                                                <i class="fas fa-folder"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-textHeading">{{ $subcategory->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-textParagraph">{{ Str::limit($subcategory->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-textParagraph">
                                        {{ $subcategory->services->count() }} services
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('admin.categories.show', $subcategory->id) }}" class="btn-secondary py-1 px-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $subcategory->id) }}" class="btn-primary py-1 px-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Services in this Category -->
    @if($category->services->count() > 0)
        <div class="card mt-6">
            <div class="p-6 border-b border-secondary">
                <h3 class="text-xl font-bold text-textHeading">Services in this Category</h3>
            </div>
            
            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-secondary">
                        <thead class="bg-bgPrimary">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Provider</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-textHeading uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary">
                            @foreach($category->services as $service)
                                <tr class="hover:bg-bgPrimary transition-colors duration-150">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-textHeading">{{ $service->title }}</div>
                                        <div class="text-xs text-secondary">{{ Str::limit($service->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-textParagraph">
                                        {{ $service->user->name ?? 'Unknown Provider' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-tertiary">
                                        ${{ number_format($service->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $service->status == 'published' ? 'bg-tertiary bg-opacity-20 text-tertiary' : 
                                               ($service->status == 'draft' ? 'bg-yellow-500 bg-opacity-20 text-yellow-500' : 
                                               'bg-secondary bg-opacity-20 text-secondary') }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="#" class="btn-secondary py-1 px-2" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn-primary py-1 px-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection