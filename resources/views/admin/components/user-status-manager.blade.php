<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Gestion du statut utilisateur</h3>
            <div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <span class="h-2 w-2 mr-1 rounded-full bg-green-500"></span>
                    Actif
                </span>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="space-y-6">
            <!-- Current Status Info -->
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-gray-400">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Statut actuel</h3>
                    <div class="mt-2 text-sm text-gray-600">
                        <p>
                            L'utilisateur est actuellement <span class="font-medium text-green-600">actif</span> sur la plateforme et peut accéder à toutes les fonctionnalités.
                        </p>
                        <p class="mt-1">
                            Dernière modification: <time datetime="2024-01-20">20/01/2024 à 15:30</time>
                            par Admin
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Status Change Form -->
            <div class="border-t border-gray-200 pt-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-900">Modifier le statut</h3>
                    <div class="mt-2 space-y-5">
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="status-active" name="status" type="radio" value="active" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status-active" class="font-medium text-gray-700">Actif</label>
                                <p class="text-gray-500">L'utilisateur pourra accéder à toutes les fonctionnalités de la plateforme.</p>
                            </div>
                        </div>
                        
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="status-inactive" name="status" type="radio" value="inactive" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status-inactive" class="font-medium text-gray-700">Inactif</label>
                                <p class="text-gray-500">L'utilisateur est inactif mais peut se reconnecter à tout moment.</p>
                            </div>
                        </div>
                        
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="status-pending" name="status" type="radio" value="pending" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status-pending" class="font-medium text-gray-700">En attente</label>
                                <p class="text-gray-500">L'utilisateur devra être validé manuellement avant de pouvoir utiliser la plateforme.</p>
                            </div>
                        </div>
                        
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="status-blocked" name="status" type="radio" value="blocked" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="status-blocked" class="font-medium text-gray-700">Bloqué</label>
                                <p class="text-gray-500">L'utilisateur ne pourra pas se connecter ni utiliser la plateforme.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="status-reason" class="block text-sm font-medium text-gray-700">
                        Raison du changement <span class="text-gray-400">(optionnel)</span>
                    </label>
                    <div class="mt-1">
                        <textarea id="status-reason" name="status-reason" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Cette raison sera enregistrée dans l'historique des modifications du statut de l'utilisateur.</p>
                </div>
                
                <div class="mt-6">
                    <label for="status-notify" class="inline-flex items-center">
                        <input id="status-notify" name="status-notify" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Notifier l'utilisateur par email</span>
                    </label>
                </div>
            </div>
            
            <!-- Status History -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-sm font-medium text-gray-900">Historique des changements de statut</h3>
                <div class="flow-root mt-3">
                    <ul role="list" class="-mb-8">
                        <li class="text-sm text-gray-500 py-2">Aucun historique de changement de statut disponible.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        <div class="flex justify-end space-x-3">
            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Annuler
            </button>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Enregistrer
            </button>
        </div>
    </div>
</div>