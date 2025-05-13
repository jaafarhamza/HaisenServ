@extends('admin.layouts.app')

@section('title', 'Category Management')
@section('header-title', 'Category Management')

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-folder mr-2 text-highlight"></i> Category Management
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.categories.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i> Add New Category
            </a>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card p-4 mb-6">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex flex-col md:flex-row md:items-end space-y-4 md:space-y-0 md:space-x-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-textHeading mb-1">Search</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" 
                    class="input-field w-full" placeholder="Search categories...">
            </div>
            
            <div class="flex-1">
                <label for="parent_id" class="block text-sm font-medium text-textHeading mb-1">Filter by Parent</label>
                <select id="parent_id" name="parent_id" class="input-field w-full">
                    <option value="">All Categories</option>
                    <option value="0" {{ request('parent_id') === '0' ? 'selected' : '' }}>Main Categories Only</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ request('parent_id') == $parent->id ? 'selected' : '' }}>
                            Subcategories of {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <button type="submit" class="btn-primary h-10 px-4">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>
    
    <!-- Categories List -->
    <div class="card">
        <div class="p-6 border-b border-secondary flex justify-between items-center">
            <h3 class="text-xl font-bold text-textHeading">Categories List</h3>
            <span class="text-sm text-secondary">
                Showing {{ $categories->firstItem() ?? 0 }} - {{ $categories->lastItem() ?? 0 }} 
                of {{ $categories->total() }} categories
            </span>
        </div>
        
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary">
                    <thead class="bg-bgPrimary">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Services</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-textHeading uppercase tracking-wider">Subcategories</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-textHeading uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary">
                        @forelse($categories as $category)
                            <tr class="hover:bg-bgPrimary transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded bg-bgPrimary flex items-center justify-center text-highlight">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-textHeading">{{ $category->name }}</div>
                                            <div class="text-sm text-secondary">{{ Str::limit($category->description, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($category->parent)
                                        <span class="px-2 py-1 text-xs rounded-full bg-tertiary bg-opacity-20 text-tertiary">
                                            Subcategory of {{ $category->parent->name }}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-highlight bg-opacity-20 text-highlight">
                                            Main Category
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textParagraph">
                                    {{ $category->services_count ?? $category->services()->count() }} services
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-textParagraph">
                                    {{ $category->subcategories_count ?? $category->subcategories()->count() }} subcategories
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn-secondary py-1 px-2" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-primary py-1 px-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger py-1 px-2" title="Delete" 
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-textParagraph">
                                    No categories found. <a href="{{ route('admin.categories.create') }}" class="text-highlight hover:underline">Create one</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="p-4 border-t border-secondary">
            {{ $categories->links('admin.components.pagination') }}
        </div>
    </div>
@endsection