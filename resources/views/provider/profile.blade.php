@extends('provider.layouts.app')

@section('title', 'Complete Your Provider Profile')

@section('content')
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-textHeading mb-2">Complete Your Provider Profile</h1>
        <p class="text-lg text-textParagraph">Tell us more about your services to get started.</p>
    </header>

    <div class="bg-bgSecondary rounded-lg shadow-md p-6">
        <form action="{{ route('provider.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-textHeading mb-4 border-b border-secondary pb-2">
                        Personal Information</h2>
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-textParagraph mb-1">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-textParagraph mb-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading" readonly>
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-textParagraph mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-textParagraph mb-1">City</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                        class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading">
                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service Information Section -->
                <div class="col-span-2 mt-4">
                    <h2 class="text-xl font-semibold text-textHeading mb-4 border-b border-secondary pb-2">
                        Service Information</h2>
                </div>

                <!-- Include the Category Dropdown Component -->
                @include('provider.components.category-dropdown', [
                    'categories' => $categories,
                    'selectedCategories' => $selectedCategories ?? [],
                ])

                <!-- Profile Photo -->
                <div class="col-span-2 mt-2">
                    <label class="block text-sm font-medium text-textParagraph mb-2">Profile Photo</label>
                    <div class="flex items-center">
                        <div id="avatar-preview" class="w-16 h-16 bg-bgPrimary rounded-full overflow-hidden mr-4">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-textParagraph">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" id="avatar" name="avatar" class="bg-bgPrimary text-textParagraph" accept="image/*">
                            <p class="text-xs text-textParagraph mt-1">Select an image (JPEG, PNG, GIF) up to 2MB</p>
                        </div>
                    </div>
                    @error('avatar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="col-span-2 mt-2">
                    <label for="bio" class="block text-sm font-medium text-textParagraph mb-1">Bio (Tell
                        clients about your services)</label>
                    <textarea id="bio" name="bio" rows="4"
                        class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading">{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('homepage') }}"
                    class="bg-secondary hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200 mr-2">
                    Skip for Now
                </a>
                <button type="submit"
                    class="bg-buttonPrimary hover:bg-opacity-80 text-buttonText py-2 px-4 rounded-lg transition-all duration-200">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
