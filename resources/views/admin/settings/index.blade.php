@extends('layouts.admin')

@section('title', 'Paramètres de la Plateforme')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Paramètres de la Plateforme</h2>
        <p class="mt-1 text-sm text-gray-500">Configurez les paramètres généraux de la plateforme HaisenServ</p>
    </div>

    <!-- Settings Tabs -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <button class="whitespace-nowrap py-4 px-1 border-b-2 border-indigo-500 font-medium text-sm text-indigo-600 focus:outline-none" aria-current="page" data-tab="general">
                    Général
                </button>
                <button class="whitespace-nowrap py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none" data-tab="security">
                    Sécurité
                </button>
                <button class="whitespace-nowrap py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none" data-tab="payment">
                    Paiements
                </button>
                <button class="whitespace-nowrap py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none" data-tab="email">
                    Emails
                </button>
                <button class="whitespace-nowrap py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none" data-tab="api">
                    API
                </button>
                <button class="whitespace-nowrap py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none" data-tab="advanced">
                    Avancé
                </button>
            </nav>
        </div>
        
        <!-- General Settings Tab Content -->
        <div id="general-tab" class="p-6 tab-content">
            <form>
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Information de la plateforme</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Configurez les informations de base de votre plateforme.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="platform-name" class="block text-sm font-medium text-gray-700">
                                Nom de la plateforme
                            </label>
                            <div class="mt-1">
                                <input type="text" name="platform-name" id="platform-name" value="HaisenServ" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="slogan" class="block text-sm font-medium text-gray-700">
                                Slogan
                            </label>
                            <div class="mt-1">
                                <input type="text" name="slogan" id="slogan" value="La plateforme qui révolutionne la mise en relation entre clients et prestataires" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">HaisenServ est une plateforme digitale innovante qui centralise et simplifie la mise en relation entre clients et prestataires de services. Elle propose une expérience utilisateur fluide, un système de réservation intelligent, et des outils de gestion performants pour les transactions et les utilisateurs.</textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Brève description de votre plateforme. Visible sur les moteurs de recherche.</p>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                            <div class="mt-1 flex items-center">
                                <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                                    <img src="/images/logo.png" alt="Logo" class="h-10 w-10 object-contain">
                                </span>
                                <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Changer
                                </button>
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="favicon" class="block text-sm font-medium text-gray-700">Favicon</label>
                            <div class="mt-1 flex items-center">
                                <span class="h-12 w-12 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
                                    <img src="/images/favicon.ico" alt="Favicon" class="h-8 w-8 object-contain">
                                </span>
                                <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Changer
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-5 border-t border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Informations de contact</h3>
                        
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="contact-email" class="block text-sm font-medium text-gray-700">
                                    Email de contact
                                </label>
                                <div class="mt-1">
                                    <input type="email" name="contact-email" id="contact-email" value="contact@haisenserv.com" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    Téléphone
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="phone" id="phone" value="+33 1 23 45 67 89" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            
                            <div class="sm:col-span-6">
                                <label for="address" class="block text-sm font-medium text-gray-700">
                                    Adresse
                                </label>
                                <div class="mt-1">
                                    <input type="text" name="address" id="address" value="123 Avenue des Services, 75000 Paris, France" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-5 border-t border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Réseaux sociaux</h3>
                        
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="facebook" class="block text-sm font-medium text-gray-700">
                                    Facebook
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        facebook.com/
                                    </span>
                                    <input type="text" name="facebook" id="facebook" value="haisenserv" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="twitter" class="block text-sm font-medium text-gray-700">
                                    Twitter
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        twitter.com/
                                    </span>
                                    <input type="text" name="twitter" id="twitter" value="haisenserv" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300">
                                </div>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="instagram" class="block text-sm font-medium text-gray-700">
                                    Instagram
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        instagram.com/
                                    </span>
                                    <input type="text" name="instagram" id="instagram" value="haisenserv" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="linkedin" class="block text-sm font-medium text-gray-700">
                                    LinkedIn
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        linkedin.com/company/
                                    </span>
                                    <input type="text" name="linkedin" id="linkedin" value="haisenserv" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-5 border-t border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Paramètres régionaux</h3>
                        
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="language" class="block text-sm font-medium text-gray-700">Langue par défaut</label>
                                <select id="language" name="language" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="fr" selected>Français</option>
                                    <option value="en">English</option>
                                    <option value="ar">العربية</option>
                                    <option value="es">Español</option>
                                </select>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="timezone" class="block text-sm font-medium text-gray-700">Fuseau horaire</label>
                                <select id="timezone" name="timezone" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="Europe/Paris" selected>Europe/Paris (GMT+01:00)</option>
                                    <option value="Europe/London">Europe/London (GMT+00:00)</option>
                                    <option value="America/New_York">America/New_York (GMT-05:00)</option>
                                    <option value="Asia/Tokyo">Asia/Tokyo (GMT+09:00)</option>
                                </select>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="currency" class="block text-sm font-medium text-gray-700">Devise</label>
                                <select id="currency" name="currency" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="EUR" selected>Euro (€)</option>
                                    <option value="USD">US Dollar ($)</option>
                                    <option value="GBP">British Pound (£)</option>
                                    <option value="JPY">Japanese Yen (¥)</option>
                                </select>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="date-format" class="block text-sm font-medium text-gray-700">Format de date</label>
                                <select id="date-format" name="date-format" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="DD/MM/YYYY" selected>DD/MM/YYYY</option>
                                    <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Save Button -->
                <div class="pt-8 flex justify-end">
                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Annuler
                    </button>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Security Settings Tab Content (Hidden by default) -->
        <div id="security-tab" class="p-6 tab-content hidden">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Paramètres de sécurité</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Configurez les options de sécurité pour votre plateforme.
                    </p>
                </div>
                
                <!-- Security Settings Content -->
                <div class="bg-yellow-50 p-4 rounded-md border border-yellow-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Contenu de l'onglet Sécurité</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Cet onglet contiendrait les paramètres de sécurité comme l'authentification à deux facteurs, les politiques de mot de passe, etc. Pour cet exemple, il est affiché en version minimale.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Payment Settings Tab Content (Hidden by default) -->
        <div id="payment-tab" class="p-6 tab-content hidden">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Paramètres de paiement</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Configurez les options de paiement pour votre plateforme.
                    </p>
                </div>
                
                <!-- Payment Settings Content -->
                <div class="bg-yellow-50 p-4 rounded-md border border-yellow-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Contenu de l'onglet Paiements</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Cet onglet contiendrait les paramètres de paiement comme les passerelles de paiement, les commissions, etc. Pour cet exemple, il est affiché en version minimale.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Email Settings Tab Content (Hidden by default) -->
        <div id="email-tab" class="p-6 tab-content hidden">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Paramètres d'email</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Configurez les options d'email pour votre plateforme.
                    </p>
                </div>
                
                <!-- Email Settings Content -->
                <div class="bg-yellow-50 p-4 rounded-md border border-yellow-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Contenu de l'onglet Emails</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Cet onglet contiendrait les paramètres d'email comme les modèles, les configurations SMTP, etc. Pour cet exemple, il est affiché en version minimale.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- API Settings Tab Content (Hidden by default) -->
        <div id="api-tab" class="p-6 tab-content hidden">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Paramètres API</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Configurez les options API pour votre plateforme.
                    </p>
                </div>
                
                <!-- API Settings Content -->
                <div class="bg-yellow-50 p-4 rounded-md border border-yellow-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Contenu de l'onglet API</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Cet onglet contiendrait les paramètres API comme les clés d'API, les webhooks, etc. Pour cet exemple, il est affiché en version minimale.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Advanced Settings Tab Content (Hidden by default) -->
        <div id="advanced-tab" class="p-6 tab-content hidden">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Paramètres avancés</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Configurez les options avancées pour votre plateforme.
                    </p>
                </div>
                
                <!-- Advanced Settings Content -->
                <div class="bg-yellow-50 p-4 rounded-md border border-yellow-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Contenu de l'onglet Avancé</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Cet onglet contiendrait les paramètres avancés comme le cache, les performances, etc. Pour cet exemple, il est affiché en version minimale.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabButtons = document.querySelectorAll('[data-tab]');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active tab button
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-indigo-500', 'text-indigo-600');
                    btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                });
                button.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                button.classList.add('border-indigo-500', 'text-indigo-600');
                
                // Show the selected tab content
                const tabId = button.getAttribute('data-tab');
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(`${tabId}-tab`).classList.remove('hidden');
            });
        });
    });
</script>
@endpush