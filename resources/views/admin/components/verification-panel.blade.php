@props(['provider'])

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Vérification du prestataire</h3>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    En attente
                </span>
                
                <span class="text-sm text-gray-500">
                    Dernière mise à jour: 20/01/2024
                </span>
            </div>
        </div>
    </div>
    
    <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informations Personnelles -->
        <div class="lg:col-span-1">
            <h4 class="text-sm font-medium text-gray-900 mb-4">Informations Personnelles</h4>
            
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-medium">
                            JD
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="font-medium text-gray-900">John Doe</div>
                        <div class="text-gray-500 text-sm">john@example.com</div>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-4">
                    <dl class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Date de naissance</dt>
                            <dd class="text-sm text-gray-900 col-span-2">01/01/1990</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                            <dd class="text-sm text-gray-900 col-span-2">+33 6 12 34 56 78</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Adresse</dt>
                            <dd class="text-sm text-gray-900 col-span-2">123 Rue de Paris</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Ville</dt>
                            <dd class="text-sm text-gray-900 col-span-2">Paris</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Code postal</dt>
                            <dd class="text-sm text-gray-900 col-span-2">75000</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Pays</dt>
                            <dd class="text-sm text-gray-900 col-span-2">France</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        
        <!-- Documents & Certifications -->
        <div class="lg:col-span-2">
            <h4 class="text-sm font-medium text-gray-900 mb-4">Documents & Certifications</h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- Pièce d'identité -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-gray-500 mr-2">
                                <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                <rect x="7" y="8" width="3" height="3"></rect>
                                <rect x="15" y="8" width="2" height="2"></rect>
                                <rect x="15" y="12" width="2" height="2"></rect>
                                <rect x="15" y="16" width="2" height="2"></rect>
                                <rect x="7" y="12" width="6" height="6"></rect>
                            </svg>
                            <h5 class="text-sm font-medium text-gray-900">Pièce d'identité</h5>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            Soumis
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500">Format: JPG, PNG, PDF</p>
                            <p class="text-xs text-gray-500">Taille max: 5MB</p>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" class="inline-flex items-center py-1.5 px-2.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Voir
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Justificatif de domicile -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-gray-500 mr-2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <h5 class="text-sm font-medium text-gray-900">Justificatif de domicile</h5>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            Soumis
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500">Format: JPG, PNG, PDF</p>
                            <p class="text-xs text-gray-500">Taille max: 5MB</p>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" class="inline-flex items-center py-1.5 px-2.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Voir
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Certification Professionnelle -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-gray-500 mr-2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <h5 class="text-sm font-medium text-gray-900">Certification Professionnelle</h5>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            Soumis
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500">Format: JPG, PNG, PDF</p>
                            <p class="text-xs text-gray-500">Taille max: 5MB</p>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" class="inline-flex items-center py-1.5 px-2.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Voir
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Assurance Professionnelle -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-gray-500 mr-2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                            <h5 class="text-sm font-medium text-gray-900">Assurance Professionnelle</h5>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            Soumis
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500">Format: JPG, PNG, PDF</p>
                            <p class="text-xs text-gray-500">Taille max: 5MB</p>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" class="inline-flex items-center py-1.5 px-2.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Voir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-4">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Historique de vérification</h4>
                
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        <li class="text-sm text-gray-500 py-2">Aucun historique de vérification disponible.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-sm text-gray-500">
                    Vérification en attente depuis le 20/01/2024
                </span>
            </div>
            
            <div class="flex space-x-3">
                <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2 text-red-600">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    Rejeter
                </button>
                
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    Approuver
                </button>
            </div>
        </div>
    </div>
</div>