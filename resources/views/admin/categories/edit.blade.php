@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('header-title', 'Edit Category')

@section('content')
    <!-- Page Title -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-textHeading">
            <i class="fas fa-edit mr-2 text-highlight"></i> Edit Category: {{ $category->name }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn-secondary">
                <i class="fas fa-eye mr-2"></i> View Category
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Categories
            </a>
        </div>
    </div>
    
    <!-- Edit Category Form -->
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="card p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column - Basic Info -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-textHeading">Basic Information</h3>
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-textHeading mb-1">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" 
                           class="input-field w-full" placeholder="Enter category name" required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-textHeading mb-1">Description</label>
                    <textarea id="description" name="description" rows="4" 
                            class="input-field w-full" placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Parent Category -->
                <div>
                    <label for="parent_id" class="block text-sm font-medium text-textHeading mb-1">Parent Category</label>
                    <select id="parent_id" name="parent_id" class="input-field w-full">
                        <option value="">None (Main Category)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Category Slug (Read-only) -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-textHeading mb-1">Slug (Auto-generated)</label>
                    <input type="text" id="slug" value="{{ $category->slug }}" 
                           class="input-field w-full bg-bgPrimary" readonly disabled>
                    <p class="mt-1 text-xs text-secondary">The slug will be automatically updated if you change the name.</p>
                </div>
            </div>
            
            <!-- Right Column - SEO Settings -->
            <div class="space-y-6">
                <h3 class="text-lg font-medium text-textHeading">SEO Settings</h3>
                
                <!-- Meta Title -->
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-textHeading mb-1">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" 
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
                            class="input-field w-full" placeholder="Enter meta description">{{ old('meta_description', $category->meta_description) }}</textarea>
                    @error('meta_description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Meta Keywords -->
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-textHeading mb-1">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}" 
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
                        <input type="text" id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $category->canonical_url) }}" 
                               class="input-field w-full" placeholder="https://example.com/categories/your-category">
                        @error('canonical_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Open Graph Title -->
                    <div>
                        <label for="og_title" class="block text-sm font-medium text-textHeading mb-1">Open Graph Title</label>
                        <input type="text" id="og_title" name="og_title" value="{{ old('og_title', $category->og_title) }}" 
                               class="input-field w-full" placeholder="Title for social media">
                        @error('og_title')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Open Graph Description -->
                    <div>
                        <label for="og_description" class="block text-sm font-medium text-textHeading mb-1">Open Graph Description</label>
                        <textarea id="og_description" name="og_description" rows="2" 
                                class="input-field w-full" placeholder="Description for social media">{{ old('og_description', $category->og_description) }}</textarea>
                        @error('og_description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Open Graph Image URL -->
                    <div>
                        <label for="og_image_url" class="block text-sm font-medium text-textHeading mb-1">Open Graph Image URL</label>
                        <input type="text" id="og_image_url" name="og_image_url" value="{{ old('og_image_url', $category->og_image_url) }}" 
                               class="input-field w-full" placeholder="https://example.com/images/og-image.jpg">
                        @error('og_image_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Robots Directive -->
                    <div>
                        <label for="robots" class="block text-sm font-medium text-textHeading mb-1">Robots Directive</label>
                        <select id="robots" name="robots" class="input-field w-full">
                            <option value="index,follow" {{ old('robots', $category->robots) == 'index,follow' ? 'selected' : '' }}>index,follow (Default)</option>
                            <option value="noindex,follow" {{ old('robots', $category->robots) == 'noindex,follow' ? 'selected' : '' }}>noindex,follow</option>
                            <option value="index,nofollow" {{ old('robots', $category->robots) == 'index,nofollow' ? 'selected' : '' }}>index,nofollow</option>
                            <option value="noindex,nofollow" {{ old('robots', $category->robots) == 'noindex,nofollow' ? 'selected' : '' }}>noindex,nofollow</option>
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
                <i class="fas fa-save mr-2"></i> Update Category
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
        
        // Show advanced SEO fields 
        document.addEventListener('DOMContentLoaded', function() {
            const fields = [
                document.getElementById('canonical_url'),
                document.getElementById('og_title'),
                document.getElementById('og_description'),
                document.getElementById('og_image_url')
            ];
            
            const hasValue = fields.some(field => field.value.trim() !== '');
            
            if (hasValue) {
                toggleAdvancedSeo();
            }
        });
    </script>
@endsection
