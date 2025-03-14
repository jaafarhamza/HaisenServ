@extends('layouts.admin')

@section('title', 'Modifier Catégorie')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="flex items-center">
                <a href="{{ route('admin.categories.index') }}" class="mr-2 text-indigo-600 hover:text-indigo-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Modifier Catégorie</h2>
            </div>
            <p class="mt-1 text-sm text-gray-500">Mettre à jour les informations de la catégorie Services Ménagers</p>
        </div>
    </div>
    
    <form action="#" method="POST" enctype="multipart/form-data">
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
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom de la catégorie <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="Services Ménagers" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            
                            <div class="sm:col-span-6">
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug <span class="text-red-500">*</span></label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        /categories/
                                    </span>
                                    <input type="text" name="slug" id="slug" value="services-menagers" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">URL unique pour cette catégorie. Laissez vide pour générer automatiquement à partir du nom.</p>
                            </div>
                            
                            <div class="sm:col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">Description des services ménagers</textarea>
                                <p class="mt-1 text-xs text-gray-500">Description brève de la catégorie.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Visual Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Paramètres visuels</h3>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Icon Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Icône</label>
                            
                            <div class="grid grid-cols-4 sm:grid-cols-6 lg:grid-cols-8 gap-4 mb-4" id="icon-grid">
                                <!-- Common Icons -->
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors ring-2 ring-indigo-500 bg-indigo-50" data-icon="🏠">
                                    <span class="text-2xl">🏠</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🧹">
                                    <span class="text-2xl">🧹</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="👨‍🔧">
                                    <span class="text-2xl">👨‍🔧</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="💇‍♀️">
                                    <span class="text-2xl">💇‍♀️</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="👩‍⚕️">
                                    <span class="text-2xl">👩‍⚕️</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="👨‍🍳">
                                    <span class="text-2xl">👨‍🍳</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="👨‍💻">
                                    <span class="text-2xl">👨‍💻</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🔧">
                                    <span class="text-2xl">🔧</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🚚">
                                    <span class="text-2xl">🚚</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🎨">
                                    <span class="text-2xl">🎨</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="📷">
                                    <span class="text-2xl">📷</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🎓">
                                    <span class="text-2xl">🎓</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="⚖️">
                                    <span class="text-2xl">⚖️</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🏋️">
                                    <span class="text-2xl">🏋️</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🎸">
                                    <span class="text-2xl">🎸</span>
                                </div>
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" data-icon="🐕">
                                    <span class="text-2xl">🐕</span>
                                </div>
                                <!-- Custom Icon Input -->
                                <div class="icon-container cursor-pointer h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" id="custom-icon-trigger">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="hidden" id="custom-icon-container">
                                <label for="custom_icon" class="block text-sm font-medium text-gray-700">Icône personnalisée</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="custom_icon" id="custom_icon" value="" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Entrez un emoji ou un code HTML pour l'icône</p>
                            </div>
                            
                            <input type="hidden" name="icon" id="selected_icon" value="🏠">
                        </div>
                        
                        <!-- Color Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Couleur</label>
                            
                            <div class="grid grid-cols-5 sm:grid-cols-8 gap-4">
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-indigo-500 hover:ring-2 hover:ring-offset-2 hover:ring-indigo-500 ring-2 ring-offset-2 ring-indigo-500" data-color="indigo"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-purple-500 hover:ring-2 hover:ring-offset-2 hover:ring-purple-500" data-color="purple"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-pink-500 hover:ring-2 hover:ring-offset-2 hover:ring-pink-500" data-color="pink"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-red-500 hover:ring-2 hover:ring-offset-2 hover:ring-red-500" data-color="red"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-orange-500 hover:ring-2 hover:ring-offset-2 hover:ring-orange-500" data-color="orange"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-yellow-500 hover:ring-2 hover:ring-offset-2 hover:ring-yellow-500" data-color="yellow"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-green-500 hover:ring-2 hover:ring-offset-2 hover:ring-green-500" data-color="green"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-teal-500 hover:ring-2 hover:ring-offset-2 hover:ring-teal-500" data-color="teal"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-cyan-500 hover:ring-2 hover:ring-offset-2 hover:ring-cyan-500" data-color="cyan"></div>
                                <div class="color-container cursor-pointer h-10 w-10 rounded-full bg-blue-500 hover:ring-2 hover:ring-offset-2 hover:ring-blue-500" data-color="blue"></div>
                            </div>
                            
                            <input type="hidden" name="color" id="selected_color" value="indigo">
                        </div>
                        
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image de catégorie</label>
                            <div class="mt-1 flex items-center">
                                <div class="flex-shrink-0 h-20 w-20 bg-gray-100 rounded-md overflow-hidden">
                                    <div class="h-20 w-20 flex items-center justify-center text-gray-400" id="image_placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                    </div>
                                    <img src="" alt="" class="h-20 w-20 object-cover hidden" id="image_preview">
                                </div>
                                <div class="ml-4 flex">
                                    <label for="image" class="relative cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Changer</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">JPG, PNG ou GIF. Taille recommandée: 600x400px</p>
                        </div>
                    </div>
                </div>
                
                <!-- SEO Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">SEO</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700">Titre SEO</label>
                            <input type="text" name="meta_title" id="meta_title" value="Services Ménagers" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <p class="mt-1 text-xs text-gray-500">Laissez vide pour utiliser le nom de la catégorie</p>
                        </div>
                        
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700">Description SEO</label>
                            <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">Description des services ménagers</textarea>
                            <p class="mt-1 text-xs text-gray-500">Laissez vide pour utiliser la description de la catégorie</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Status -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Statut</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-900">Actif</span>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                <input type="checkbox" id="is_active" name="is_active" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" checked>
                                <label for="is_active" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500">Une catégorie inactive ne sera pas visible sur le site public.</p>
                    </div>
                </div>
                
                <!-- Category Preview -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Aperçu</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm">
                            <div id="preview_header" class="h-32 bg-indigo-500 flex items-center justify-center">
                                <span id="preview_icon" class="text-5xl text-white opacity-80">🏠</span>
                            </div>
                            
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 id="preview_name" class="text-lg font-semibold text-gray-900">Services Ménagers</h4>
                                    <div class="flex items-center">
                                        <span id="preview_color_dot" class="h-2.5 w-2.5 rounded-full bg-indigo-500 mr-2"></span>
                                        <span id="preview_color_text" class="text-sm text-gray-500 font-medium">Indigo</span>
                                    </div>
                                </div>
                                
                                <p id="preview_description" class="text-sm text-gray-500 line-clamp-2">Description des services ménagers</p>
                                
                                <div class="border-t border-gray-100 pt-3 mt-3">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg>
                                        <span>0 services</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Category Statistics -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Statistiques</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Services</span>
                                <span class="text-sm font-medium text-gray-900">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Réservations</span>
                                <span class="text-sm font-medium text-gray-900">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Chiffre d'affaires</span>
                                <span class="text-sm font-medium text-gray-900">0,00 €</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Vues</span>
                                <span class="text-sm font-medium text-gray-900">0</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Créé le 01/01/2022</span>
                                <span>Mis à jour le 01/01/2022</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Annuler
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Enregistrer les modifications
            </button>
        </div>
    </form>
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
    
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle name input for preview
        const nameInput = document.getElementById('name');
        const previewName = document.getElementById('preview_name');
        
        nameInput.addEventListener('input', function() {
            previewName.textContent = this.value || 'Nom de la catégorie';
        });
        
        // Handle description input for preview
        const descriptionInput = document.getElementById('description');
        const previewDescription = document.getElementById('preview_description');
        
        descriptionInput.addEventListener('input', function() {
            previewDescription.textContent = this.value || 'Description de la catégorie';
        });
        
        // Handle icon selection
        const iconContainers = document.querySelectorAll('.icon-container');
        const selectedIcon = document.getElementById('selected_icon');
        const previewIcon = document.getElementById('preview_icon');
        const customIconTrigger = document.getElementById('custom-icon-trigger');
        const customIconContainer = document.getElementById('custom-icon-container');
        const customIconInput = document.getElementById('custom_icon');
        
        iconContainers.forEach(container => {
            container.addEventListener('click', function() {
                if (this.id === 'custom-icon-trigger') {
                    customIconContainer.classList.remove('hidden');
                    // Reset other selections
                    iconContainers.forEach(c => {
                        if (c.id !== 'custom-icon-trigger') {
                            c.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-50');
                        }
                    });
                    
                    // If there's already a custom icon, use it
                    if (customIconInput.value) {
                        selectedIcon.value = customIconInput.value;
                        previewIcon.textContent = customIconInput.value;
                    }
                } else {
                    const icon = this.getAttribute('data-icon');
                    
                    // Reset other selections
                    iconContainers.forEach(c => {
                        c.classList.remove('ring-2', 'ring-indigo-500', 'bg-indigo-50');
                    });
                    
                    // Hide custom icon input
                    customIconContainer.classList.add('hidden');
                    
                    // Set selected
                    this.classList.add('ring-2', 'ring-indigo-500', 'bg-indigo-50');
                    selectedIcon.value = icon;
                    previewIcon.textContent = icon;
                }
            });
        });
        
        // Handle custom icon input
        customIconInput.addEventListener('input', function() {
            selectedIcon.value = this.value;
            previewIcon.textContent = this.value;
        });
        
        // Handle color selection
        const colorContainers = document.querySelectorAll('.color-container');
        const selectedColor = document.getElementById('selected_color');
        const previewHeader = document.getElementById('preview_header');
        const previewColorDot = document.getElementById('preview_color_dot');
        const previewColorText = document.getElementById('preview_color_text');
        
        colorContainers.forEach(container => {
            container.addEventListener('click', function() {
                const color = this.getAttribute('data-color');
                
                // Reset all selections
                colorContainers.forEach(c => {
                    c.classList.remove('ring-2', 'ring-offset-2', `ring-${c.getAttribute('data-color')}-500`);
                });
                
                // Set selected
                this.classList.add('ring-2', 'ring-offset-2', `ring-${color}-500`);
                selectedColor.value = color;
                
                // Update preview
                previewHeader.className = `h-32 bg-${color}-500 flex items-center justify-center`;
                previewColorDot.className = `h-2.5 w-2.5 rounded-full bg-${color}-500 mr-2`;
                previewColorText.textContent = color.charAt(0).toUpperCase() + color.slice(1);
            });
        });
        
        // Handle image upload
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image_preview');
        const imagePlaceholder = document.getElementById('image_placeholder');
        
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    imagePlaceholder.classList.add('hidden');
                };
                
                reader.readAsDataURL(file);
            }
        });
        
        // Handle image removal
        const removeImageButton = document.getElementById('remove_image');
        const removeImageInput = document.getElementById('remove_image_input');
        
        if (removeImageButton) {
            removeImageButton.addEventListener('click', function() {
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
                imagePlaceholder.classList.remove('hidden');
                imageInput.value = '';
                removeImageInput.value = '1';
            });
        }
        
        // Auto-generate slug from name
        const slugInput = document.getElementById('slug');
        
        nameInput.addEventListener('blur', function() {
            if (!slugInput.value) {
                // Simple slug generation (you might want to use a more robust solution)
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                
                slugInput.value = slug;
            }
        });
    });
</script>
@endpush