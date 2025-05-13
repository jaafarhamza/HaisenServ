@extends('layouts.auth')

@section('title', 'Select Your Role')
@section('meta_description', 'Choose whether you want to use HaisenServ as a client or service provider.')
@section('meta_keywords', 'role selection, client, provider, account setup, HaisenServ')

@section('content')
    <div class="text-center mb-6 staggered">
        <div class="w-14 h-14 mx-auto mb-3 text-buttonPrimary float">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <h2 class="text-xl font-bold text-textHeading">Choose Your Role</h2>
        <p class="mt-1 text-textParagraph text-xs">
            Select how you want to use HaisenServ
        </p>
    </div>
    
    @if ($errors->any())
        <div class="bg-bgPrimary border-l-4 border-tertiary text-tertiary p-3 mb-4 rounded-md fade-in" role="alert">
            <div class="flex items-start">
                <svg class="h-4 w-4 mr-2 text-tertiary mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="text-xs">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <form action="{{ route('role.select') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="client">
            <button type="submit" class="w-full h-48 p-6 bg-bgPrimary rounded-lg border border-secondary hover:border-highlight transition-all duration-300">
                <div class="flex flex-col items-center justify-center h-full">
                    <div class="w-16 h-16 text-highlight mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-textHeading mb-2">Client</h3>
                    <p class="text-sm text-textParagraph text-center">
                        Find and book services from professionals
                    </p>
                </div>
            </button>
        </form>
        
        <form action="{{ route('role.select') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="provider">
            <button type="submit" class="w-full h-48 p-6 bg-bgPrimary rounded-lg border border-secondary hover:border-highlight transition-all duration-300">
                <div class="flex flex-col items-center justify-center h-full">
                    <div class="w-16 h-16 text-highlight mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-textHeading mb-2">Service Provider</h3>
                    <p class="text-sm text-textParagraph text-center">
                        Offer your services and grow your business
                    </p>
                </div>
            </button>
        </form>
    </div>
    <div class="mt-6 text-center">
        <form action="{{ route('role.select') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="skip">
            <button type="submit" class="text-highlight hover:text-buttonPrimary transition-colors duration-300">
                Skip
            </button>
        </form>
    </div>
@endsection

@section('footer_links')
    <p class="mt-3 text-textParagraph hover:text-textHeading transition-colors duration-300 text-xs">
        Already know what you want?
        <a href="{{ route('login') }}" class="font-medium text-highlight hover:text-buttonPrimary transition-colors duration-300">
            Go back to login
        </a>
    </p>
@endsection