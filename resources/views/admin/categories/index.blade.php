@extends('layouts.admin')

@section('title', 'Gestion des Catégories')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Gestion des Catégories</h2>
                <p class="mt-1 text-sm text-gray-500">Gérez les catégories de services disponibles sur la plateforme</p>
            </div>
            <button data-modal-target="create-category-modal" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Ajouter une catégorie
            </button>
        </div>
        
        <!-- Category Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="relative h-32 bg-gradient-to-r from-{{ $category->color }}-500 to-{{ $category->color }}-600 flex items-center justify-center">
                    <!-- Category Icon -->
                    <span class="text-5xl text-white opacity-80">{!! $category->icon !!}</span>
                    
                    <!-- Quick Actions -->
                    <div class="absolute top-3 right-3 flex space-x-1">
                        <button class="p-1.5 bg-white/20 hover:bg-white/30 rounded-full text-white transition-colors" title="Modifier">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="p-1.5 bg-white/20 hover:bg-white/30 rounded-full text-white transition-colors" title="Supprimer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Status Indicator -->
                    @if($category->is_active)
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <span class="h-1.5 w-1.5 mr-1 rounded-full bg-green-600"></span>
                            Actif
                        </span>
                    </div>
                    @else
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            <span class="h-1.5 w-1.5 mr-1 rounded-full bg-gray-500"></span>
                            Inactif
                        </span>
                    </div>
                    @endif
                </div>
                
                <div class="p-5">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                        <div class="flex items-center">
                            <span class="inline-block h-2.5 w-2.5 rounded-full bg-{{ $category->color }}-500 mr-2"></span>
                            <span class="text-sm text-gray-500 font-medium">{{ ucfirst($category->color) }}</span>
                        </div>
                    </div>
                    
                    <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $category->description }}</p>
                    
                    <div class="border-t border-gray-100 pt-4 mt-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3 text-sm">
                                <div class="flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                    </svg>
                                    <span>{{ $category->services_count }} services</span>
                                </div>
                                
                                <div class="flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <span>{{ $category->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <div class="relative inline-block">
                                <!-- Toggle for active/inactive state -->
                                <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                    <input type="checkbox" id="toggle-{{ $category->id }}" name="toggle-{{ $category->id }}" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" {{ $category->is_active ? 'checked' : '' }}>
                                    <label for="toggle-{{ $category->id }}" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Add New Category Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 border-dashed overflow-hidden hover:shadow-md transition-shadow duration-300 cursor-pointer" data-modal-target="create-category-modal">
            <div class="h-full flex flex-col items-center justify-center p-8 text-gray-400 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 mb-4">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <p class="text-center font-medium">Ajouter une nouvelle catégorie</p>
            </div>
        </div>
    </div>
    
    <!-- Create Category Modal -->
    <div id="create-category-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Créer une nouvelle catégorie
                            </h3>
                            <div class="mt-6 space-y-4">
                                <div>
                                    <label for="category-name" class="block text-sm font-medium text-gray-700">Nom</label>
                                    <input type="text" name="category-name" id="category-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                
                                <div>
                                    <label for="category-description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea id="category-description" name="category-description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                
                                <div>
                                    <label for="category-icon" class="block text-sm font-medium text-gray-700">Icône</label>
                                    <div class="mt-1 flex items-center">
                                        <span class="inline-block h-12 w-12 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center text-gray-400 text-2xl">
                                            🏠
                                        </span>
                                        <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Choisir
                                        </button>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="category-color" class="block text-sm font-medium text-gray-700">Couleur</label>
                                    <div class="mt-1 grid grid-cols-8 gap-2">
                                        <div class="h-6 w-6 rounded-full bg-indigo-500 cursor-pointer ring-2 ring-offset-2 ring-indigo-500"></div>
                                        <div class="h-6 w-6 rounded-full bg-purple-500 cursor-pointer"></div>
                                        <div class="h-6 w-6 rounded-full bg-pink-500 cursor-pointer"></div>
                                        <div class="h-6 w-6 rounded-full bg-red-500 cursor-pointer"></div>
                                        <div class="h-6 w-6 rounded-full bg-orange-500 cursor-pointer"></div>
                                        <div class="h-6 w-6 rounded-full bg-yellow-500 cursor-pointer"></div>
                                        <div class="h-6 w-6 rounded-full bg-green-500 cursor-pointer"></div>
                                        <div class="h-6 w-6 rounded-full bg-blue-500 cursor-pointer"></div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <input id="category-active" name="category-active" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="category-active" class="ml-2 block text-sm text-gray-900">
                                        Activer la catégorie
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Créer
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm modal-close">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .toggle-checkbox:checked {
        right: 0;
        border-color: #4f46e5;
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #4f46e5;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal handling
        const modalTriggers = document.querySelectorAll('[data-modal-target]');
        const modalCloses = document.querySelectorAll('.modal-close');
        
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const modalId = trigger.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                }
            });
        });
        
        modalCloses.forEach(close => {
            close.addEventListener('click', () => {
                const modal = close.closest('[id^="create-category-modal"]');
                if (modal) {
                    modal.classList.add('hidden');
                }
            });
        });
        
        // Handle clicks outside the modal
        window.addEventListener('click', (e) => {
            const modals = document.querySelectorAll('[id^="create-category-modal"]');
            modals.forEach(modal => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush