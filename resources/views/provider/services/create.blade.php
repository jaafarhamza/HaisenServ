@extends('provider.layouts.app')

@section('title', 'Create Service')

@section('content')
<header class="mb-8">
    <h1 class="text-3xl font-bold text-textHeading mb-2">Create Your Service</h1>
    <p class="text-lg text-textParagraph">Provide details about the service you want to offer.</p>
</header>

<div class="bg-bgSecondary rounded-lg shadow-md p-6">
    <form action="{{ route('provider.services.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Service Information Section -->
            <div class="col-span-2">
                <h2 class="text-xl font-semibold text-textHeading mb-4 border-b border-secondary pb-2">Service Information</h2>
            </div>

            <!-- Title -->
            <div class="col-span-2">
                <label for="title" class="block text-sm font-medium text-textParagraph mb-1">Service Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" 
                    class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="col-span-2">
                <label for="description" class="block text-sm font-medium text-textParagraph mb-1">Description *</label>
                <textarea id="description" name="description" rows="6" 
                    class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-textParagraph mb-1">Price *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-textParagraph">$</span>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0"
                        class="w-full bg-bgPrimary border border-secondary rounded-lg pl-8 px-4 py-2 text-textHeading" required>
                </div>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- City -->
            <div>
                <label for="city" class="block text-sm font-medium text-textParagraph mb-1">City *</label>
                <input type="text" id="city" name="city" value="{{ old('city', Auth::user()->city) }}" 
                    class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading" required>
                @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="col-span-2">
                <label for="category_id" class="block text-sm font-medium text-textParagraph mb-1">Category *</label>
                <select id="category_id" name="category_id" 
                    class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id') == $category->id || in_array($category->id, $userCategories ?? []) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('homepage') }}" class="bg-secondary hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200 mr-2">
                Cancel
            </a>
            <button type="submit" class="bg-buttonPrimary hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200">
                Create Service
            </button>
        </div>
    </form>
</div>
@endsection