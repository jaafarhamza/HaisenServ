@extends('layouts.admin')

@section('title', 'Transactions Financières')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Transactions Financières</h2>
            <p class="mt-1 text-sm text-gray-500">Suivez toutes les transactions de paiement sur la plateforme</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative">
                <input type="text" 
                       placeholder="Rechercher une transaction..." 
                       class="py-2 pl-10 pr-4 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-gray-400">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
            </div>
            <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Exporter
            </button>
        </div>
    </div>
    
    <!-- Financial Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-indigo-100 text-indigo-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Revenu Total</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ number_format($totalRevenue, 2, ',', ' ') }} €</h3>
                    <p class="text-sm text-green-600 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        +8.2% ce mois
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-purple-100 text-purple-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                        <line x1="2" y1="10" x2="22" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Commissions</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ number_format($totalCommissions, 2, ',', ' ') }} €</h3>
                    <p class="text-sm text-green-600 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        +5.4% ce mois
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-green-100 text-green-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Transactions Complétées</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ number_format($completedTransactions) }}</h3>
                    <p class="text-sm text-green-600 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        +12.3% ce mois
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="rounded-full p-3 bg-red-100 text-red-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Transactions Échouées</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ number_format($failedTransactions) }}</h3>
                    <p class="text-sm text-red-600 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                            <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                            <polyline points="17 18 23 18 23 12"></polyline>
                        </svg>
                        +1.8% ce mois
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Transaction Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Filtres</h3>
            <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                Réinitialiser
            </button>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="status-filter" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select id="status-filter" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <option value="">Tous les statuts</option>
                        <option value="completed">Complété</option>
                        <option value="pending">En attente</option>
                        <option value="failed">Échoué</option>
                        <option value="refunded">Remboursé</option>
                    </select>
                </div>
                <div>
                    <label for="date-filter" class="block text-sm font-medium text-gray-700 mb-1">Période</label>
                    <select id="date-filter" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <option value="">Toutes les périodes</option>
                        <option value="today">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="year">Cette année</option>
                    </select>
                </div>
                <div>
                    <label for="amount-filter" class="block text-sm font-medium text-gray-700 mb-1">Montant</label>
                    <select id="amount-filter" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <option value="">Tous les montants</option>
                        <option value="0-50">0€ - 50€</option>
                        <option value="50-100">50€ - 100€</option>
                        <option value="100-500">100€ - 500€</option>
                        <option value="500+">500€ et plus</option>
                    </select>
                </div>
                <div>
                    <label for="payment-method-filter" class="block text-sm font-medium text-gray-700 mb-1">Méthode de paiement</label>
                    <select id="payment-method-filter" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <option value="">Toutes les méthodes</option>
                        <option value="card">Carte bancaire</option>
                        <option value="stripe">Stripe</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank-transfer">Virement bancaire</option>
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
    
    <!-- Transactions Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="min-w-full divide-y divide-gray-200">
            <div class="bg-gray-50">
                <div class="grid grid-cols-12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="col-span-1">#ID</div>
                    <div class="col-span-2">Client</div>
                    <div class="col-span-2">Service</div>
                    <div class="col-span-1">Montant</div>
                    <div class="col-span-1">Commission</div>
                    <div class="col-span-2">Date</div>
                    <div class="col-span-1">Méthode</div>
                    <div class="col-span-1">Statut</div>
                    <div class="col-span-1 text-center">Actions</div>
                </div>
            </div>
            <div class="bg-white divide-y divide-gray-200">
                @foreach($transactions as $transaction)
                <div class="grid grid-cols-12 px-6 py-4 whitespace-nowrap text-sm text-gray-500 items-center hover:bg-gray-50 transition-colors">
                    <div class="col-span-1 font-medium text-indigo-600">
                        #{{ $transaction->id }}
                    </div>
                    <div class="col-span-2">
                        <div class="flex items-center">
                            <div class="h-8 w-8 flex-shrink-0">
                                @if($transaction->user->avatar)
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $transaction->user->avatar }}" alt="{{ $transaction->user->name }}">
                                @else
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-medium">
                                        {{ strtoupper(substr($transaction->user->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <div class="font-medium text-gray-900">{{ $transaction->user->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 truncate">
                        {{ $transaction->service->name }}
                    </div>
                    <div class="col-span-1 font-medium text-gray-900">
                        {{ number_format($transaction->amount, 2, ',', ' ') }}€
                    </div>
                    <div class="col-span-1">
                        {{ number_format($transaction->commission, 2, ',', ' ') }}€
                    </div>
                    <div class="col-span-2">
                        <div>{{ $transaction->created_at->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }}</div>
                    </div>
                    <div class="col-span-1">
                        @if($transaction->payment_method == 'card')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                <svg class="h-3 w-3 mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="2"/>
                                    <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Carte
                            </span>
                        @elseif($transaction->payment_method == 'paypal')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                PayPal
                            </span>
                        @elseif($transaction->payment_method == 'stripe')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                Stripe
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Autre
                            </span>
                        @endif
                    </div>
                    <div class="col-span-1">
                        @if($transaction->status == 'completed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="h-1.5 w-1.5 mr-1 rounded-full bg-green-500"></span>
                                Complété
                            </span>
                        @elseif($transaction->status == 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <span class="h-1.5 w-1.5 mr-1 rounded-full bg-yellow-500"></span>
                                En attente
                            </span>
                        @elseif($transaction->status == 'failed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <span class="h-1.5 w-1.5 mr-1 rounded-full bg-red-500"></span>
                                Échoué
                            </span>
                        @elseif($transaction->status == 'refunded')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <span class="h-1.5 w-1.5 mr-1 rounded-full bg-blue-500"></span>
                                Remboursé
                            </span>
                        @endif
                    </div>
                    <div class="col-span-1 text-center">
                        <div class="flex justify-center space-x-1">
                            <button class="p-1 rounded hover:bg-gray-100 text-gray-600 hover:text-gray-900" title="Voir les détails">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                            <button class="p-1 rounded hover:bg-gray-100 text-gray-600 hover:text-gray-900" title="Télécharger le reçu">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                            </button>
                            @if($transaction->status == 'completed')
                            <button class="p-1 rounded hover:bg-gray-100 text-gray-600 hover:text-gray-900" title="Rembourser">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="border-t border-gray-200 px-4 py-3 flex items-center justify-between sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">10</span> sur <span class="font-medium">{{ $transactions->total() }}</span> transactions
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Précédent</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            2
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            3
                        </a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            8
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            9
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            10
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Suivant</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection