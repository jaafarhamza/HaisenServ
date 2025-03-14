<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Graphique Activité de la Plateforme -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Activité de la plateforme</h3>
                <div class="relative">
                    <select id="activity-period" class="pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                        <option value="7">7 derniers jours</option>
                        <option value="30">30 derniers jours</option>
                        <option value="90">3 derniers mois</option>
                        <option value="365">12 derniers mois</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4">
            <!-- Activity Metrics Summary -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="border border-gray-100 rounded-lg p-3 text-center">
                    <p class="text-sm text-gray-500 mb-1">Réservations</p>
                    <div class="text-xl font-bold text-gray-900">150</div>
                    <div class="text-xs mt-1 text-green-600">
                        +12.5%
                    </div>
                </div>
                
                <div class="border border-gray-100 rounded-lg p-3 text-center">
                    <p class="text-sm text-gray-500 mb-1">Nouveaux Utilisateurs</p>
                    <div class="text-xl font-bold text-gray-900">85</div>
                    <div class="text-xs mt-1 text-green-600">
                        +8.3%
                    </div>
                </div>
                
                <div class="border border-gray-100 rounded-lg p-3 text-center">
                    <p class="text-sm text-gray-500 mb-1">Taux de Conversion</p>
                    <div class="text-xl font-bold text-gray-900">15.5%</div>
                    <div class="text-xs mt-1 text-green-600">
                        +5.2%
                    </div>
                </div>
            </div>
            
            <!-- Activity Chart -->
            <div class="h-64">
                <canvas id="activityChart" data-chart="activity"></canvas>
            </div>
            
            <!-- Chart Legend -->
            <div class="flex justify-center space-x-6 mt-4">
                <div class="flex items-center">
                    <span class="h-3 w-3 rounded-full bg-indigo-500 mr-2"></span>
                    <span class="text-sm text-gray-700">Réservations</span>
                </div>
                <div class="flex items-center">
                    <span class="h-3 w-3 rounded-full bg-purple-500 mr-2"></span>
                    <span class="text-sm text-gray-700">Nouveaux utilisateurs</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Graphique Catégories Populaires -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Catégories populaires</h3>
                <div class="relative">
                    <select id="categories-period" class="pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                        <option value="30">30 derniers jours</option>
                        <option value="90">3 derniers mois</option>
                        <option value="365">12 derniers mois</option>
                        <option value="all">Tout le temps</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Categories Chart -->
                <div class="lg:col-span-2">
                    <div class="h-64">
                        <canvas id="categoriesChart" data-chart="categories"></canvas>
                    </div>
                </div>
                
                <!-- Categories Ranking -->
                <div class="lg:col-span-1 flex flex-col">
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Classement par réservations</h4>
                    <div class="space-y-3 overflow-y-auto flex-grow" style="max-height: 250px;">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900">Services domestiques</span>
                                    <span class="text-sm text-gray-500">35%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 35%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <path d="M20 7h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z"></path>
                                    <path d="M12 4v16"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900">Services professionnels</span>
                                    <span class="text-sm text-gray-500">25%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-purple-500 h-1.5 rounded-full" style="width: 25%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center text-pink-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <circle cx="9" cy="9" r="5"></circle>
                                    <path d="M15.163 15.163a2 2 0 0 1 0 2.828l-4.242 4.243a2 2 0 0 1-2.828 0L4.93 19.07a2 2 0 0 1 0-2.828l4.243-4.242a2 2 0 0 1 2.828 0zM9 9l.01 0"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900">Beauté</span>
                                    <span class="text-sm text-gray-500">20%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-pink-500 h-1.5 rounded-full" style="width: 20%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-cyan-100 flex items-center justify-center text-cyan-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900">Santé</span>
                                    <span class="text-sm text-gray-500">15%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-cyan-500 h-1.5 rounded-full" style="width: 15%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-green-600 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-900">Autres</span>
                                    <span class="text-sm text-gray-500">5%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 5%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Demographics & Geographic Distribution -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- User Demographics -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Démographie des utilisateurs</h3>
                <div class="relative">
                    <select id="demographics-filter" class="pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                        <option value="all">Tous les utilisateurs</option>
                        <option value="clients">Clients</option>
                        <option value="providers">Prestataires</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Age Distribution -->
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Répartition par âge</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">18-24 ans</span>
                            <span class="text-xs text-gray-700">15%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 15%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">25-34 ans</span>
                            <span class="text-xs text-gray-700">32%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 32%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">35-44 ans</span>
                            <span class="text-xs text-gray-700">28%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 28%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">45-54 ans</span>
                            <span class="text-xs text-gray-700">18%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 18%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500">55+ ans</span>
                            <span class="text-xs text-gray-700">7%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 7%"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Gender & Device Distribution -->
                <div class="space-y-6">
                    <!-- Gender Distribution -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Répartition par genre</h4>
                        <div class="flex items-center">
                            <div class="flex-1 text-center">
                                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8">
                                        <path d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"></path>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-900">52%</div>
                                <div class="text-xs text-gray-500">Hommes</div>
                            </div>
                            
                            <div class="h-16 w-px bg-gray-200 mx-4"></div>
                            
                            <div class="flex-1 text-center">
                                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-pink-100 text-pink-600 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8">
                                        <path d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"></path>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-900">48%</div>
                                <div class="text-xs text-gray-500">Femmes</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Device Distribution -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Appareils utilisés</h4>
                        <div class="flex items-center">
                            <div class="flex-1 text-center">
                                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-600 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-900">65%</div>
                                <div class="text-xs text-gray-500">Mobile</div>
                            </div>
                            
                            <div class="flex-1 text-center">
                                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 text-gray-600 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="3" y1="9" x2="21" y2="9"></line>
                                        <line x1="3" y1="15" x2="21" y2="15"></line>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-900">28%</div>
                                <div class="text-xs text-gray-500">Desktop</div>
                            </div>
                            
                            <div class="flex-1 text-center">
                                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-green-100 text-green-600 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                        <line x1="8" y1="21" x2="16" y2="21"></line>
                                        <line x1="12" y1="17" x2="12" y2="21"></line>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-900">7%</div>
                                <div class="text-xs text-gray-500">Tablette</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Geographic Distribution -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Distribution géographique</h3>
                <div class="relative">
                    <select id="geo-filter" class="pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
                        <option value="all">Tous les utilisateurs</option>
                        <option value="clients">Clients</option>
                        <option value="providers">Prestataires</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4">
            <!-- Map Visualization Placeholder -->
            <div class="bg-gray-100 rounded-lg h-48 mb-4 flex items-center justify-center">
                <div class="text-gray-500 text-sm">Carte de France avec répartition</div>
            </div>
            
            <!-- Top Cities -->
            <h4 class="text-sm font-medium text-gray-700 mb-3">Principales villes</h4>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Paris</span>
                        <span class="text-xs text-gray-700">28%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 28%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Lyon</span>
                        <span class="text-xs text-gray-700">15%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 15%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Marseille</span>
                        <span class="text-xs text-gray-700">12%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 12%"></div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Bordeaux</span>
                        <span class="text-xs text-gray-700">9%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 9%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Toulouse</span>
                        <span class="text-xs text-gray-700">7%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 7%"></div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Autres</span>
                        <span class="text-xs text-gray-700">29%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 29%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>