<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Services en attente d'approbation</h3>
            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                Voir tout
            </a>
        </div>
    </div>

    <div class="overflow-hidden">
        <div class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150 border-b border-gray-100">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 mr-4">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div>
                        <h4 class="text-gray-900 font-medium">Titre du service</h4>
                        <p class="text-sm text-gray-500">Catégorie</p>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        En attente
                    </span>
                    <span class="ml-3 text-xs text-gray-500">Il y a 2 heures</span>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-8 w-8 flex-shrink-0">
                        <div class="h-8 w-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-medium">
                            JD
                        </div>
                    </div>
                    <div class="ml-3">
                        <span class="text-sm text-gray-900">John Doe</span>
                        
                        <div class="flex items-center mt-0.5">
                            <span class="inline-flex items-center text-xs text-green-600 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-0.5">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                Vérifié
                            </span>
                            
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3 w-3">
                                        <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>
                                    </svg>
                                    <!-- Repeat 4 more times for 5 stars total -->
                                </div>
                                <span class="ml-1 text-xs text-gray-500">(25)</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="flex space-x-2">
                        <a href="#" class="inline-flex items-center p-1.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors" title="Voir les détails">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-500">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                        
                        <form action="#" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center p-1.5 border border-gray-300 rounded-lg hover:bg-green-50 hover:border-green-300 hover:text-green-700 transition-colors" title="Approuver">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-500 hover:text-green-500">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </button>
                        </form>
                        
                        <form action="#" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center p-1.5 border border-gray-300 rounded-lg hover:bg-red-50 hover:border-red-300 hover:text-red-700 transition-colors" title="Rejeter">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-500 hover:text-red-500">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <div class="text-sm text-gray-600 line-clamp-2">Description du service...</div>
            </div>
            
            <div class="mt-3 flex flex-wrap items-center gap-2">
                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    50,00€
                </div>
                
                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    2 heures
                </div>
                
                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5 mr-1">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    À domicile
                </div>
            </div>
        </div>
    </div>
</div>