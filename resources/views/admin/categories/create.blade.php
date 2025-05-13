@extends('admin.layouts.app')

@section('title', 'Create Category')
@section('header-title', 'Create New Category')

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-folder-plus mr-2 text-highlight"></i> Create New Category
        </h2>
        <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Categories
        </a>
    </div>
    
    <!-- Create Category Form -->
    <form action="{{ route('admin.categories.store') }}" method="POST" class="card p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column - Basic Info -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-textHeading">Basic Information</h3>
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-textHeading mb-1">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                           class="input-field w-full" placeholder="Enter category name" required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-textHeading mb-1">Description</label>
                    <textarea id="description" name="description" rows="4" 
                            class="input-field w-full" placeholder="Enter category description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Parent Category -->
                <div>
                    <label for="parent_id" class="block text-sm font-medium text-textHeading mb-1">Parent Category</label>
                    <select id="parent_id" name="parent_id" class="input-field w-full">
                        <option value="">None (Create as Main Category)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Right Column - SEO Settings -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-textHeading">SEO Settings</h3>
                
                <!-- Meta Title -->
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-textHeading mb-1">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" 
                           class="input-field w-full" placeholder="Enter meta title">
                    <p class="mt-1 text-xs text-secondary">If left empty, category name will be used.</p>
                    @error('meta_title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Meta Description -->
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-textHeading mb-1">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="2" 
                            class="input-field w-full" placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Meta Keywords -->
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-textHeading mb-1">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" 
                           class="input-field w-full" placeholder="keyword1, keyword2, keyword3">
                    @error('meta_keywords')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Advanced SEO Settings Toggle -->
                <div class="mt-4">
                    <div class="flex items-center space-x-2 cursor-pointer" onclick="toggleAdvancedSeo()">
                        <div id="advancedSeoToggle" class="h-5 w-5 rounded border border-secondary flex items-center justify-center">
                            <i class="fas fa-plus text-xs text-secondary"></i>
                        </div>
                        <span class="text-sm font-medium text-textHeading">Advanced SEO Settings</span>
                    </div>
                </div>
                
                <!-- Advanced SEO Fields (Hidden by Default) -->
                <div id="advancedSeoFields" class="hidden space-y-4 mt-4">
                    <!-- Canonical URL -->
                    <div>
                        <label for="canonical_url" class="block text-sm font-medium text-textHeading mb-1">Canonical URL</label>
                        <input type="text" id="canonical_url" name="canonical_url" value="{{ old('canonical_url') }}" 
                               class="input-field w-full" placeholder="https://example.com/categories/your-category">
                        @error('canonical_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Open Graph Title -->
                    <div>
                        <label for="og_title" class="block text-sm font-medium text-textHeading mb-1">Open Graph Title</label>
                        <input type="text" id="og_title" name="og_title" value="{{ old('og_title') }}" 
                               class="input-field w-full" placeholder="Title for social media">
                        @error('og_title')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Open Graph Description -->
                    <div>
                        <label for="og_description" class="block text-sm font-medium text-textHeading mb-1">Open Graph Description</label>
                        <textarea id="og_description" name="og_description" rows="2" 
                                class="input-field w-full" placeholder="Description for social media">{{ old('og_description') }}</textarea>
                        @error('og_description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Open Graph Image URL -->
                    <div>
                        <label for="og_image_url" class="block text-sm font-medium text-textHeading mb-1">Open Graph Image URL</label>
                        <input type="text" id="og_image_url" name="og_image_url" value="{{ old('og_image_url') }}" 
                               class="input-field w-full" placeholder="https://example.com/images/og-image.jpg">
                        @error('og_image_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Robots Directive -->
                    <div>
                        <label for="robots" class="block text-sm font-medium text-textHeading mb-1">Robots Directive</label>
                        <select id="robots" name="robots" class="input-field w-full">
                            <option value="index,follow" {{ old('robots') == 'index,follow' ? 'selected' : '' }}>index,follow (Default)</option>
                            <option value="noindex,follow" {{ old('robots') == 'noindex,follow' ? 'selected' : '' }}>noindex,follow</option>
                            <option value="index,nofollow" {{ old('robots') == 'index,nofollow' ? 'selected' : '' }}>index,nofollow</option>
                            <option value="noindex,nofollow" {{ old('robots') == 'noindex,nofollow' ? 'selected' : '' }}>noindex,nofollow</option>
                        </select>
                        @error('robots')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8 flex justify-end">
            <button type="button" class="btn-secondary mr-3" onclick="history.back()">Cancel</button>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save mr-2"></i> Create Category
            </button>
        </div>
    </form>
    
    <script>
        function toggleAdvancedSeo() {
            const fields = document.getElementById('advancedSeoFields');
            const toggle = document.getElementById('advancedSeoToggle');
            
            if (fields.classList.contains('hidden')) {
                fields.classList.remove('hidden');
                toggle.innerHTML = '<i class="fas fa-minus text-xs text-secondary"></i>';
            } else {
                fields.classList.add('hidden');
                toggle.innerHTML = '<i class="fas fa-plus text-xs text-secondary"></i>';
            }
        }
    </script>
@endsection