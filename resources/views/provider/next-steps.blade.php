@extends('provider.layouts.app')

@section('title', 'Next Steps')

@section('content')
<header class="text-center mb-12">
    <div class="mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-highlight" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-textHeading mb-2">Profile Completed!</h1>
    <p class="text-lg text-textParagraph">What would you like to do next?</p>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Create Service Card -->
    <div class="bg-bgSecondary rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
        <div class="h-48 flex items-center justify-center bg-highlight bg-opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-highlight" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </div>
        <div class="p-6">
            <h2 class="text-xl font-bold text-textHeading mb-2">Create Your First Service</h2>
            <p class="text-textParagraph mb-4">Start offering your professional services to potential clients right away.</p>
            <a href="{{ route('provider.services.create') }}" class="block w-full bg-buttonPrimary hover:bg-opacity-80 text-buttonText py-3 px-4 rounded-lg transition-all duration-200 text-center">
                Create Service
            </a>
        </div>
    </div>

    <!-- Go to Home Card -->
    <div class="bg-bgSecondary rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105">
        <div class="h-48 flex items-center justify-center bg-tertiary bg-opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-tertiary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </div>
        <div class="p-6">
            <h2 class="text-xl font-bold text-textHeading mb-2">Go to Homepage</h2>
            <p class="text-textParagraph mb-4">Explore the platform first and create your services later.</p>
            <a href="{{ route('homepage') }}" class="block w-full bg-secondary hover:bg-opacity-80 text-buttonText py-3 px-4 rounded-lg transition-all duration-200 text-center">
                Go to Homepage
            </a>
        </div>
    </div>
</div>

<div class="mt-12 text-center">
    <p class="text-textParagraph">You can always manage your services later from your dashboard.</p>
</div>
@endsection