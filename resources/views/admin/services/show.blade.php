@extends('layouts.admin')

@section('title', 'Détails du Service')

@section('content')
<div class="space-y-6">
    <!-- Page Header with Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="flex items-center">
                <a href="{{ route('admin.services.index') }}" class="mr-2 text-indigo-600 hover:text-indigo-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">{{ $service->title }}</h2>
                @if($service->status === 'active')
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <span class="h-2 w-2 mr-1 rounded-full bg-green-500"></span>
                        Actif
                    </span>
                @elseif($service->status === 'inactive')
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <span class="h-2 w-2 mr-1 rounded-full bg-gray-500"></span>
                        Inactif
                    </span>
                @elseif($service->status === 'pending')
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <span class="h-2 w-2 mr-1 rounded-full bg-yellow-500"></span>
                        En attente
                    </span>
                @elseif($service->status === 'rejected')
                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <span class="h-2 w-2 mr-1 rounded-full bg-red-500"></span>
                        Rejeté
                    </span>
                @endif
            </div>
            <p class="mt-1 text-sm text-gray-500">Créé le {{ $service->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.services.edit', $service->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Modifier
            </a>
            
            @if($service->status === 'pending')
                <form action="{{ route('admin.services.approve', $service->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Approuver
                    </button>
                </form>
                
                <form action="{{ route('admin.services.reject', $service->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Rejeter
                    </button>
                </form>
            @elseif($service->status === 'active')
                <form action="{{ route('admin.services.deactivate', $service->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                        </svg>
                        Désactiver
                    </button>
                </form>
            @elseif($service->status === 'inactive' || $service->status === 'rejected')
                <form action="{{ route('admin.services.activate', $service->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Activer
                    </button>
                </form>
            @endif
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Service Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Service Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Détails du service</h3>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-6">
                        <!-- Service Images -->
                        <div class="sm:w-1/3">
                            <div class="mb-4">
                                @if($service->images && count($service->images) > 0)
                                    <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden">
                                        <img src="{{ $service->images[0] }}" alt="{{ $service->title }}" class="object-cover">
                                    </div>
                                    
                                    @if(count($service->images) > 1)
                                        <div class="mt-2 grid grid-cols-3 gap-2">
                                            @foreach(array_slice($service->images, 1, 3) as $image)
                                                <div class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden">
                                                    <img src="{{ $image }}" alt="{{ $service->title }}" class="object-cover">
                                                </div>
                                            @endforeach
                                            
                                            @if(count($service->images) > 4)
                                                <div class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden relative">
                                                    <img src="{{ $service->images[4] }}" alt="{{ $service->title }}" class="object-cover">
                                                    <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center">
                                                        <span class="text-white font-medium">+{{ count($service->images) - 4 }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    <div class="aspect-w-4 aspect-h-3 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 text-gray-300">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full {{ 'bg-' . $service->category->color . '-100' }} flex items-center justify-center {{ 'text-' . $service->category->color . '-600' }}">
                                        {!! $service->category->icon !!}
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $service->category->name }}</h4>
                                        @if($service->subcategory)
                                            <p class="text-xs text-gray-500">{{ $service->subcategory }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <div class="text-gray-500">Prix</div>
                                        <div class="font-medium text-gray-900">
                                            {{ $service->price_type === 'fixed' ? number_format($service->price, 2, ',', ' ') . '€' : 'À partir de ' . number_format($service->price, 2, ',', ' ') . '€' }}
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="text-gray-500">Durée</div>
                                        <div class="font-medium text-gray-900">
                                            {{ $service->duration }} {{ Str::plural('heure', $service->duration) }}
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="text-gray-500">Type</div>
                                        <div class="font-medium text-gray-900">
                                            {{ $service->location_type === 'at_home' ? 'À domicile' : 'En extérieur' }}
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="text-gray-500">Réservations</div>
                                        <div class="font-medium text-gray-900">
                                            {{ $service->bookings_count ?? 0 }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Service Description -->
                        <div class="sm:w-2/3">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">{{ $service->title }}</h3>
                            
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 mr-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $service->average_rating)
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                                <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 text-gray-300">
                                                <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-500">{{ number_format($service->average_rating, 1) }} ({{ $service->reviews_count ?? 0 }} avis)</span>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 mb-6">
                                <p>{{ $service->description }}</p>
                            </div>
                            
                            @if($service->features && count($service->features) > 0)
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Ce qui est inclus :</h4>
                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($service->features as $feature)
                                            <li class="flex items-center text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2 text-green-500">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            @if($service->requirements && count($service->requirements) > 0)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Prérequis :</h4>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        @foreach($service->requirements as $requirement)
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2 text-indigo-500 mt-0.5">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                </svg>
                                                {{ $requirement }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reviews -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Avis des clients</h3>
                        <span class="text-sm text-gray-500">{{ $service->reviews_count ?? 0 }} avis</span>
                    </div>
                </div>
                
                <div class="divide-y divide-gray-200">
                    @forelse($service->reviews ?? [] as $review)
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    @if($review->user->avatar)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $review->user->avatar }}" alt="{{ $review->user->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-sm font-medium">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $review->user->name }}</h4>
                                        <time datetime="{{ $review->created_at->format('Y-m-d') }}" class="text-xs text-gray-500">
                                            {{ $review->created_at->format('d/m/Y') }}
                                        </time>
                                    </div>
                                    
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                                                        <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4 text-gray-300">
                                                        <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500">{{ $review->booking_date->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    <p class="mt-2 text-sm text-gray-600">{{ $review->comment }}</p>
                                    
                                    @if($review->provider_response)
                                        <div class="mt-3 bg-gray-50 rounded-lg p-3">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    @if($service->provider->user->avatar)
                                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ $service->provider->user->avatar }}" alt="{{ $service->provider->user->name }}">
                                                    @else
                                                        <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center text-white text-xs font-medium">
                                                            {{ strtoupper(substr($service->provider->user->name, 0, 2)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <h5 class="text-xs font-medium text-gray-900">Réponse de {{ $service->provider->user->name }}</h5>
                                                        <time datetime="{{ $review->provider_response_date->format('Y-m-d') }}" class="text-xs text-gray-500">
                                                            {{ $review->provider_response_date->format('d/m/Y') }}
                                                        </time>
                                                    </div>
                                                    <p class="mt-1 text-xs text-gray-600">{{ $review->provider_response }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="mt-3 flex justify-end">
                                        <button type="button" class="inline-flex items-center text-xs font-medium text-gray-700 hover:text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                                            </svg>
                                            Signaler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 text-gray-300 mx-auto mb-3">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <h4 class="text-gray-500 text-sm">Aucun avis pour ce service</h4>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Bookings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Réservations récentes</h3>
                        <span class="text-sm text-gray-500">{{ count($service->bookings ?? []) }} réservations</span>
                    </div>
                </div>
                
                <div class="divide-y divide-gray-200">
                    @forelse($service->bookings ?? [] as $booking)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    @if($booking->user->avatar)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $booking->user->avatar }}" alt="{{ $booking->user->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-sm font-medium">
                                            {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</h4>
                                        <div>
                                            @if($booking->status === 'confirmed')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="h-1.5 w-1.5 mr-1 rounded-full bg-green-500"></span>
                                                    Confirmée
                                                </span>
                                            @elseif($booking->status === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <span class="h-1.5 w-1.5 mr-1 rounded-full bg-yellow-500"></span>
                                                    En attente
                                                </span>
                                            @elseif($booking->status === 'completed')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <span class="h-1.5 w-1.5 mr-1 rounded-full bg-blue-500"></span>
                                                    Terminée
                                                </span>
                                            @elseif($booking->status === 'cancelled')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="h-1.5 w-1.5 mr-1 rounded-full bg-red-500"></span>
                                                    Annulée
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    <span class="h-1.5 w-1.5 mr-1 rounded-full bg-gray-500"></span>
                                                    {{ $booking->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3 flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="inline-flex items-center text-sm text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg>
                                                {{ $booking->scheduled_at->format('d/m/Y à H:i') }}
                                            </div>
                                            
                                            <div class="inline-flex items-center text-sm text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                                {{ number_format($booking->total_price, 2, ',', ' ') }}€
                                            </div>
                                        </div>
                                        
                                        <div class="text-xs text-gray-500">
                                            Réservé le {{ $booking->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 text-gray-300 mx-auto mb-3">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <h4 class="text-gray-500 text-sm">Aucune réservation pour ce service</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Provider Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Prestataire</h3>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="h-12 w-12 flex-shrink-0">
                            @if($service->provider->user->avatar)
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ $service->provider->user->avatar }}" alt="{{ $service->provider->user->name }}">
                            @else
                                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-medium">
                                    {{ strtoupper(substr($service->provider->user->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <div class="font-medium text-gray-900">{{ $service->provider->user->name }}</div>
                            <div class="text-gray-500 text-sm">{{ $service->provider->title ?? 'Prestataire de services' }}</div>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex items-center">
                        <div class="flex text-yellow-400 mr-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $service->provider->rating)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                                        <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4 text-gray-300">
                                        <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500">{{ number_format($service->provider->rating, 1) }} ({{ $service->provider->reviews_count ?? 0 }} avis)</span>
                    </div>
                    
                    <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500">Services</div>
                            <div class="font-medium text-gray-900">{{ $service->provider->services_count ?? 0 }}</div>
                        </div>
                        
                        <div>
                            <div class="text-gray-500">Réservations</div>
                            <div class="font-medium text-gray-900">{{ $service->provider->bookings_count ?? 0 }}</div>
                        </div>
                        
                        <div>
                            <div class="text-gray-500">Statut</div>
                            <div class="font-medium text-gray-900">
                                @if($service->provider->verification_status === 'verified')
                                    <span class="inline-flex items-center text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                        Vérifié
                                    </span>
                                @elseif($service->provider->verification_status === 'pending')
                                    <span class="inline-flex items-center text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        En attente
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                        </svg>
                                        Non vérifié
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <div class="text-gray-500">Membre depuis</div>
                            <div class="font-medium text-gray-900">{{ $service->provider->user->created_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.users.show', $service->provider->user->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Voir le profil
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Service Statistics -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Statistiques</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <div class="text-sm font-medium text-gray-900">Taux de conversion</div>
                                <div class="text-sm font-medium text-gray-900">{{ number_format($service->conversion_rate ?? 0, 1) }}%</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-indigo-500 h-1.5 rounded-full" style="width: {{ $service->conversion_rate ?? 0 }}%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <div class="text-sm font-medium text-gray-900">Taux de satisfaction</div>
                                <div class="text-sm font-medium text-gray-900">{{ number_format($service->satisfaction_rate ?? 0, 1) }}%</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $service->satisfaction_rate ?? 0 }}%"></div>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-2xl font-bold text-gray-900">{{ $service->views_count ?? 0 }}</div>
                                    <div class="text-xs text-gray-500">Vues</div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-2xl font-bold text-gray-900">{{ $service->clicks_count ?? 0 }}</div>
                                    <div class="text-xs text-gray-500">Clics</div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-2xl font-bold text-gray-900">{{ $service->bookings_count ?? 0 }}</div>
                                    <div class="text-xs text-gray-500">Réservations</div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-2xl font-bold text-gray-900">{{ $service->revenue ?? 0 }}€</div>
                                    <div class="text-xs text-gray-500">Revenus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Service Availability -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-medium text-gray-900">Disponibilité</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $index => $day)
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-900">{{ $day }}</div>
                                <div class="text-sm text-gray-500">
                                    @if(isset($service->availability[$index]))
                                        @if($service->availability[$index]['available'])
                                            {{ $service->availability[$index]['start_time'] }} - {{ $service->availability[$index]['end_time'] }}
                                        @else
                                            <span class="text-red-500">Indisponible</span>
                                        @endif
                                    @else
                                        <span class="text-red-500">Indisponible</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection