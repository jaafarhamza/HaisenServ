@extends('layouts.admin')

@section('title', 'Modifier Service')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="flex items-center">
                <a href="{{ route('admin.services.show', $service->id) }}" class="mr-2 text-indigo-600 hover:text-indigo-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Modifier Service</h2>
            </div>
            <p class="mt-1 text-sm text-gray-500">Mettre à jour les informations du service {{ $service->title }}</p>
        </div>
    </div>
    
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Informations de base</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                            <div class="sm:col-span-6">
                                <label for="title" class="block text-sm font-medium text-gray-700">Titre du service <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie <span class="text-red-500">*</span></label>
                                <select id="category_id" name="category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="subcategory" class="block text-sm font-medium text-gray-700">Sous-catégorie</label>
                                <input type="text" name="subcategory" id="subcategory" value="{{ old('subcategory', $service->subcategory) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('subcategory')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                                <textarea id="description" name="description" rows="5" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $service->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Service Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Détails du service</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                            <div class="sm:col-span-2">
                                <label for="price" class="block text-sm font-medium text-gray-700">Prix <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">€</span>
                                    </div>
                                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $service->price) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">EUR</span>
                                    </div>
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="price_type" class="block text-sm font-medium text-gray-700">Type de prix</label>
                                <select id="price_type" name="price_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="fixed" {{ old('price_type', $service->price_type) == 'fixed' ? 'selected' : '' }}>Prix fixe</option>
                                    <option value="from" {{ old('price_type', $service->price_type) == 'from' ? 'selected' : '' }}>À partir de</option>
                                    <option value="hourly" {{ old('price_type', $service->price_type) == 'hourly' ? 'selected' : '' }}>Tarif horaire</option>
                                </select>
                                @error('price_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="duration" class="block text-sm font-medium text-gray-700">Durée (heures) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.5" min="0.5" name="duration" id="duration" value="{{ old('duration', $service->duration) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="location_type" class="block text-sm font-medium text-gray-700">Type de service</label>
                                <select id="location_type" name="location_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="at_home" {{ old('location_type', $service->location_type) == 'at_home' ? 'selected' : '' }}>À domicile</option>
                                    <option value="at_provider" {{ old('location_type', $service->location_type) == 'at_provider' ? 'selected' : '' }}>Chez le prestataire</option>
                                    <option value="remote" {{ old('location_type', $service->location_type) == 'remote' ? 'selected' : '' }}>À distance</option>
                                    <option value="mixed" {{ old('location_type', $service->location_type) == 'mixed' ? 'selected' : '' }}>Mixte</option>
                                </select>
                                @error('location_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="service_area" class="block text-sm font-medium text-gray-700">Zone de service</label>
                                <input type="text" name="service_area" id="service_area" value="{{ old('service_area', $service->service_area) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="ex: Paris et sa banlieue">
                                @error('service_area')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Features and Requirements -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Caractéristiques et prérequis</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="features" class="block text-sm font-medium text-gray-700">Caractéristiques (une par ligne)</label>
                            <div class="mt-1">
                                <textarea id="features" name="features" rows="4" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('features', is_array($service->features) ? implode("\n", $service->features) : $service->features) }}</textarea>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Décrivez ce qui est inclus dans votre service, une caractéristique par ligne.</p>
                            @error('features')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="requirements" class="block text-sm font-medium text-gray-700">Prérequis (une par ligne)</label>
                            <div class="mt-1">
                                <textarea id="requirements" name="requirements" rows="4" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('requirements', is_array($service->requirements) ? implode("\n", $service->requirements) : $service->requirements) }}</textarea>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Indiquez ce que le client doit fournir ou préparer, un prérequis par ligne.</p>
                            @error('requirements')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Service Images -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Images du service</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" id="image-preview-container">
                                @if($service->images && count($service->images) > 0)
                                    @foreach($service->images as $index => $image)
                                        <div class="relative" id="image-container-{{ $index }}">
                                            <div class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden">
                                                <img src="{{ $image }}" alt="{{ $service->title }}" class="object-cover">
                                            </div>
                                            <button type="button" class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none" onclick="removeImage({{ $index }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ajouter de nouvelles images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Télécharger des fichiers</span>
                                            <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                        </label>
                                        <p class="pl-1">ou glisser-déposer</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 5MB</p>
                                </div>
                            </div>
                            @error('images')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Service Availability -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Disponibilité</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <p class="text-sm text-gray-500">Définissez les jours et heures où le service est disponible.</p>
                        
                        <div class="space-y-4">
                            @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $index => $day)
                                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                    <div class="w-full sm:w-1/4">
                                        <div class="flex items-center">
                                            <input id="day_available_{{ $index }}" name="day_available[{{ $index }}]" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                                {{ (isset($service->availability[$index]) && $service->availability[$index]['available']) ? 'checked' : '' }}>
                                            <label for="day_available_{{ $index }}" class="ml-2 block text-sm font-medium text-gray-700">
                                                {{ $day }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="w-full sm:w-3/4 grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="start_time_{{ $index }}" class="block text-xs font-medium text-gray-500">Heure de début</label>
                                            <input type="time" id="start_time_{{ $index }}" name="start_time[{{ $index }}]" 
                                                value="{{ isset($service->availability[$index]) ? $service->availability[$index]['start_time'] : '09:00' }}" 
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                {{ (isset($service->availability[$index]) && !$service->availability[$index]['available']) ? 'disabled' : '' }}>
                                        </div>
                                        <div>
                                            <label for="end_time_{{ $index }}" class="block text-xs font-medium text-gray-500">Heure de fin</label>
                                            <input type="time" id="end_time_{{ $index }}" name="end_time[{{ $index }}]" 
                                                value="{{ isset($service->availability[$index]) ? $service->availability[$index]['end_time'] : '18:00' }}" 
                                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                {{ (isset($service->availability[$index]) && !$service->availability[$index]['available']) ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="pt-4 flex items-start">
                            <div class="flex items-center h-5">
                                <input id="custom_availability" name="custom_availability" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $service->custom_availability ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="custom_availability" class="font-medium text-gray-700">Disponibilité personnalisée</label>
                                <p class="text-gray-500">Cochez cette option si les disponibilités sont plus complexes ou varient selon les semaines. Vous devrez les préciser manuellement avec le client.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Service Provider -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Prestataire</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                @if($service->provider->user->avatar)
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $service->provider->user->avatar }}" alt="{{ $service->provider->user->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-medium">
                                        {{ strtoupper(substr($service->provider->user->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="font-medium text-gray-900">{{ $service->provider->user->name }}</div>
                                <div class="text-sm text-gray-500">
                                    @if($service->provider->verification_status === 'verified')
                                        <span class="inline-flex items-center text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                            Vérifié
                                        </span>
                                    @else
                                        <span>{{ $service->provider->verification_status }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @if($currentUser->isAdmin())
                            <div class="mt-4">
                                <label for="provider_id" class="block text-sm font-medium text-gray-700">Changer de prestataire</label>
                                <select id="provider_id" name="provider_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}" {{ $service->provider_id == $provider->id ? 'selected' : '' }}>{{ $provider->user->name }}</option>
                                    @endforeach
                                </select>
                                @error('provider_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" name="provider_id" value="{{ $service->provider_id }}">
                        @endif
                    </div>
                </div>
                
                <!-- Service Status -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Statut du service</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                                <option value="pending" {{ old('status', $service->status) == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="rejected" {{ old('status', $service->status) == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="status_reason" class="block text-sm font-medium text-gray-700">Raison du statut (optionnel)</label>
                            <textarea id="status_reason" name="status_reason" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('status_reason', $service->status_reason) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Cette raison sera visible pour le prestataire.</p>
                            @error('status_reason')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-start mt-4">
                            <div class="flex items-center h-5">
                                <input id="notify_provider" name="notify_provider" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" checked>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="notify_provider" class="font-medium text-gray-700">Notifier le prestataire</label>
                                <p class="text-gray-500">Envoyer un email au prestataire pour l'informer du changement.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Service Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Paramètres</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_featured" name="is_featured" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $service->is_featured ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_featured" class="font-medium text-gray-700">Service en vedette</label>
                                <p class="text-gray-500">Mettre ce service en évidence sur la page d'accueil et dans les résultats de recherche.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="instant_booking" name="instant_booking" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $service->instant_booking ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="instant_booking" class="font-medium text-gray-700">Réservation instantanée</label>
                                <p class="text-gray-500">Permettre aux clients de réserver sans approbation préalable du prestataire.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="allow_cancellation" name="allow_cancellation" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ $service->allow_cancellation ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="allow_cancellation" class="font-medium text-gray-700">Autoriser les annulations</label>
                                <p class="text-gray-500">Permettre aux clients d'annuler leur réservation.</p>
                            </div>
                        </div>
                        
                        <div>
                            <label for="cancellation_policy" class="block text-sm font-medium text-gray-700">Politique d'annulation</label>
                            <select id="cancellation_policy" name="cancellation_policy" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" {{ !$service->allow_cancellation ? 'disabled' : '' }}>
                                <option value="flexible" {{ old('cancellation_policy', $service->cancellation_policy) == 'flexible' ? 'selected' : '' }}>Flexible (jusqu'à 24h avant)</option>
                                <option value="moderate" {{ old('cancellation_policy', $service->cancellation_policy) == 'moderate' ? 'selected' : '' }}>Modérée (jusqu'à 3 jours avant)</option>
                                <option value="strict" {{ old('cancellation_policy', $service->cancellation_policy) == 'strict' ? 'selected' : '' }}>Stricte (jusqu'à 7 jours avant)</option>
                                <option value="no_refund" {{ old('cancellation_policy', $service->cancellation_policy) == 'no_refund' ? 'selected' : '' }}>Aucun remboursement</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Service Metadata -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Métadonnées</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700">Titre SEO</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $service->meta_title) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-xs text-gray-500">Laissez vide pour utiliser le titre du service.</p>
                        </div>
                        
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700">Description SEO</label>
                            <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('meta_description', $service->meta_description) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Laissez vide pour utiliser la description du service.</p>
                        </div>
                        
                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Mots-clés SEO</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $service->meta_keywords) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-xs text-gray-500">Séparés par des virgules.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.services.show', $service->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Annuler
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle availability checkboxes
        const availabilityCheckboxes = document.querySelectorAll('[id^="day_available_"]');
        
        availabilityCheckboxes.forEach(checkbox => {
            const index = checkbox.id.split('_').pop();
            const startTimeInput = document.getElementById(`start_time_${index}`);
            const endTimeInput = document.getElementById(`end_time_${index}`);
            
            // Initial state
            updateTimeInputs(checkbox, startTimeInput, endTimeInput);
            
            // Change event
            checkbox.addEventListener('change', function() {
                updateTimeInputs(checkbox, startTimeInput, endTimeInput);
            });
        });
        
        function updateTimeInputs(checkbox, startTimeInput, endTimeInput) {
            if (checkbox.checked) {
                startTimeInput.disabled = false;
                endTimeInput.disabled = false;
            } else {
                startTimeInput.disabled = true;
                endTimeInput.disabled = true;
            }
        }
        
        // Handle cancellation policy toggle
        const allowCancellationCheckbox = document.getElementById('allow_cancellation');
        const cancellationPolicySelect = document.getElementById('cancellation_policy');
        
        allowCancellationCheckbox.addEventListener('change', function() {
            cancellationPolicySelect.disabled = !this.checked;
        });
        
        // File uploads preview
        const imagesInput = document.getElementById('images');
        
        imagesInput.addEventListener('change', function(event) {
            const files = event.target.files;
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                if (!file.type.startsWith('image/')) {
                    continue;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewContainer = document.getElementById('image-preview-container');
                    
                    // Create new image preview
                    const newImageContainer = document.createElement('div');
                    newImageContainer.className = 'relative';
                    
                    newImageContainer.innerHTML = `
                        <div class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden">
                            <img src="${e.target.result}" alt="Image preview" class="object-cover">
                        </div>
                        <button type="button" class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none remove-new-image">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    `;
                    
                    previewContainer.appendChild(newImageContainer);
                    
                    // Add remove button functionality
                    const removeButton = newImageContainer.querySelector('.remove-new-image');
                    removeButton.addEventListener('click', function() {
                        newImageContainer.remove();
                    });
                };
                
                reader.readAsDataURL(file);
            }
        });
        
        // Remove existing image
        window.removeImage = function(index) {
            const imageContainer = document.getElementById(`image-container-${index}`);
            if (imageContainer) {
                imageContainer.remove();
            }
        };
    });
</script>
@endpush