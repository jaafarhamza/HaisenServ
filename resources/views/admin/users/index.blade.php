@extends('layouts.admin')

@section('title', 'Gestion des Utilisateurs')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Gestion des Utilisateurs</h2>
                <p class="mt-1 text-sm text-gray-500">Gérez tous les comptes utilisateurs sur la plateforme</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative">
                    <input type="text" 
                           placeholder="Rechercher un utilisateur..." 
                           class="py-2 pl-10 pr-4 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-gray-400">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Filtres</h3>
                <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    Réinitialiser
                </button>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="role-filter" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                        <select id="role-filter" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">Tous les rôles</option>
                            <option value="client">Client</option>
                            <option value="provider">Prestataire</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                    <div>
                        <label for="status-filter" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        <select id="status-filter" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">Tous les statuts</option>
                            <option value="active">Actif</option>
                            <option value="inactive">Inactif</option>
                            <option value="pending">En attente</option>
                            <option value="blocked">Bloqué</option>
                        </select>
                    </div>
                    <div>
                        <label for="date-filter" class="block text-sm font-medium text-gray-700 mb-1">Date d'inscription</label>
                        <select id="date-filter" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">Toutes les dates</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                            <option value="year">Cette année</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" class="px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Appliquer
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="min-w-full divide-y divide-gray-200">
                <div class="bg-gray-50">
                    <div class="grid grid-cols-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="col-span-1"></div>
                        <div class="col-span-3">Utilisateur</div>
                        <div class="col-span-2">Email</div>
                        <div class="col-span-2">Rôle</div>
                        <div class="col-span-2">Statut</div>
                        <div class="col-span-2 text-center">Actions</div>
                    </div>
                </div>
                <div class="bg-white divide-y divide-gray-200">
                    @if(isset($users) && count($users) > 0)
                        @foreach($users as $user)
                        <div class="grid grid-cols-12 px-6 py-4 whitespace-nowrap text-sm text-gray-500 items-center hover:bg-gray-50 transition-colors">
                            <div class="col-span-1">
                                <div class="cursor-pointer">
                                    <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        @if($user->avatar)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-medium">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-gray-500 text-xs">Inscrit le {{ $user->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <span class="truncate">{{ $user->email }}</span>
                            </div>
                            <div class="col-span-2">
                                @if($user->role == 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Administrateur
                                    </span>
                                @elseif($user->role == 'provider')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Prestataire
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Client
                                    </span>
                                @endif
                            </div>
                            <div class="col-span-2">
                                @if($user->status == 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="h-2 w-2 mr-1 rounded-full bg-green-500"></span>
                                        Actif
                                    </span>
                                @elseif($user->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <span class="h-2 w-2 mr-1 rounded-full bg-yellow-500"></span>
                                        En attente
                                    </span>
                                @elseif($user->status == 'blocked')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="h-2 w-2 mr-1 rounded-full bg-red-500"></span>
                                        Bloqué
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <span class="h-2 w-2 mr-1 rounded-full bg-gray-500"></span>
                                        Inactif
                                    </span>
                                @endif
                            </div>
                            <div class="col-span-2 text-center space-x-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3 w-3 mr-1">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    Voir
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3 w-3 mr-1">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Éditer
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="px-6 py-4 text-center text-gray-500">
                            <p>Aucun utilisateur trouvé</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Pagination -->
            @if(isset($users) && $users->count() > 0)
            <div class="border-t border-gray-200 px-4 py-3 flex items-center justify-between sm:px-6">
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Affichage de <span class="font-medium">{{ $users->firstItem() ?? 0 }}</span> 
                            à <span class="font-medium">{{ $users->lastItem() ?? 0 }}</span> 
                            sur <span class="font-medium">{{ $users->total() ?? 0 }}</span> utilisateurs
                        </p>
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection