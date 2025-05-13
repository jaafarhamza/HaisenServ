@extends('admin.layouts.app')

@section('title', 'Create Service')
@section('header-title', 'Create New Service')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-textHeading">Create New Service</h1>
        <a href="{{ route('admin.services.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Services
        </a>
    </div>
</div>

<div class="card">
    <div class="p-6">
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Basic Information -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-textHeading mb-4">Basic Information</h2>
                    
                    <div class="form-group">
                        <label for="title" class="block text-sm font-medium text-textParagraph mb-1">Title*</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" 
                            class="input-field w-full @error('title') border-red-500 @enderror" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="block text-sm font-medium text-textParagraph mb-1">Description*</label>
                        <textarea name="description" id="description" rows="6"
                            class="input-field w-full @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="price" class="block text-sm font-medium text-textParagraph mb-1">Price*</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0"
                                class="input-field w-full @error('price') border-red-500 @enderror" required>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city" class="block text-sm font-medium text-textParagraph mb-1">City</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" 
                                class="input-field w-full @error('city') border-red-500 @enderror" 
                                placeholder="Enter city">
                            @error('city')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="status" class="block text-sm font-medium text-textParagraph mb-1">Status*</label>
                            <select name="status" id="status" class="input-field w-full @error('status') border-red-500 @enderror" required>
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $key }}" @if(old('status') == $key) selected @endif>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="category_id" class="block text-sm font-medium text-textParagraph mb-1">Category*</label>
                            <select name="category_id" id="category_id" class="input-field w-full @error('category_id') border-red-500 @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="user_id" class="block text-sm font-medium text-textParagraph mb-1">Provider*</label>
                            <select name="user_id" id="user_id" class="input-field w-full @error('user_id') border-red-500 @enderror" required>
                                <option value="">Select Provider</option>
                                <!-- You'll need to fetch providers from the database -->
                                @if(old('user_id'))
                                    <option value="{{ old('user_id') }}" selected>Provider ID: {{ old('user_id') }}</option>
                                @endif
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- SEO Information -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-textHeading mb-4">SEO Information</h2>
                    
                    <div class="form-group">
                        <label for="meta_title" class="block text-sm font-medium text-textParagraph mb-1">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" 
                            class="input-field w-full @error('meta_title') border-red-500 @enderror">
                        @error('meta_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="meta_description" class="block text-sm font-medium text-textParagraph mb-1">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3"
                            class="input-field w-full @error('meta_description') border-red-500 @enderror">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="meta_keywords" class="block text-sm font-medium text-textParagraph mb-1">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" 
                            class="input-field w-full @error('meta_keywords') border-red-500 @enderror">
                        <small class="text-secondary text-xs">Separate keywords with commas</small>
                        @error('meta_keywords')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="slug" class="block text-sm font-medium text-textParagraph mb-1">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                            class="input-field w-full @error('slug') border-red-500 @enderror">
                        <small class="text-secondary text-xs">Leave empty to generate automatically from title</small>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="canonical_url" class="block text-sm font-medium text-textParagraph mb-1">Canonical URL</label>
                        <input type="text" name="canonical_url" id="canonical_url" value="{{ old('canonical_url') }}" 
                            class="input-field w-full @error('canonical_url') border-red-500 @enderror">
                        @error('canonical_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="og_title" class="block text-sm font-medium text-textParagraph mb-1">OG Title</label>
                        <input type="text" name="og_title" id="og_title" value="{{ old('og_title') }}" 
                            class="input-field w-full @error('og_title') border-red-500 @enderror">
                        @error('og_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="og_description" class="block text-sm font-medium text-textParagraph mb-1">OG Description</label>
                        <textarea name="og_description" id="og_description" rows="3"
                            class="input-field w-full @error('og_description') border-red-500 @enderror">{{ old('og_description') }}</textarea>
                        @error('og_description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="og_image_url" class="block text-sm font-medium text-textParagraph mb-1">OG Image URL</label>
                        <input type="text" name="og_image_url" id="og_image_url" value="{{ old('og_image_url') }}" 
                            class="input-field w-full @error('og_image_url') border-red-500 @enderror">
                        @error('og_image_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end">
                <button type="reset" class="btn-secondary mr-2">
                    <i class="fas fa-undo mr-2"></i> Reset
                </button>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i> Create Service
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    
    titleInput.addEventListener('blur', function() {
        if (slugInput.value === '') {
            const slug = this.value
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            
            slugInput.value = slug;
        }
    });
    
    // Auto-fill meta fields if empty
    titleInput.addEventListener('blur', function() {
        const metaTitleInput = document.getElementById('meta_title');
        const ogTitleInput = document.getElementById('og_title');
        
        if (metaTitleInput.value === '') {
            metaTitleInput.value = this.value;
        }
        
        if (ogTitleInput.value === '') {
            ogTitleInput.value = this.value;
        }
    });
    
    const descriptionInput = document.getElementById('description');
    descriptionInput.addEventListener('blur', function() {
        const metaDescInput = document.getElementById('meta_description');
        const ogDescInput = document.getElementById('og_description');
        
        if (metaDescInput.value === '') {
            metaDescInput.value = this.value.substring(0, 160);
        }
        
        if (ogDescInput.value === '') {
            ogDescInput.value = this.value.substring(0, 160);
        }
    });
</script>
@endpush