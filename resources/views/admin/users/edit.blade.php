@extends('layouts.admin')

@section('title', 'Modifier Utilisateur')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="flex items-center">
                <a href="#" class="mr-2 text-indigo-600 hover:text-indigo-800">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Modifier Utilisateur</h2>
            </div>
            <p class="mt-1 text-sm text-gray-500">Mettre à jour les informations</p>
        </div>
    </div>
    
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Photo de profil</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-center mb-6">
                            <div id="avatar-placeholder" class="h-24 w-24 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-2xl font-medium">
                                AB
                            </div>
                            <img id="avatar-preview" class="h-24 w-24 rounded-full object-cover hidden" src="" alt="User">
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <label for="avatar" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                Changer la photo
                            </label>
                            <input id="avatar" name="avatar" type="file" accept="image/*" class="hidden">
                            
                            <button type="button" id="remove-avatar" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                Supprimer la photo
                            </button>
                            <input type="hidden" name="remove_avatar" id="remove_avatar" value="0">
                            
                            <p class="mt-2 text-xs text-gray-500">JPG, PNG ou GIF. Max 2MB.</p>
                            
                            <p class="mt-1 text-sm text-red-600"></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Informations du compte</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
                            <select id="role" name="role" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="client">Client</option>
                                <option value="provider">Prestataire</option>
                                <option value="admin">Administrateur</option>
                            </select>
                            <p class="mt-1 text-sm text-red-600"></p>
                        </div>
                        
                        <div>
                            <label for="email_verified" class="block text-sm font-medium text-gray-700">Vérification de l'email</label>
                            <select id="email_verified" name="email_verified" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="1">Vérifié</option>
                                <option value="0">Non vérifié</option>
                            </select>
                            <p class="mt-1 text-sm text-red-600"></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date d'inscription</label>
                            <div class="mt-1 text-sm text-gray-500">
                                01/01/2021 à 12:00
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dernière connexion</label>
                            <div class="mt-1 text-sm text-gray-500">
                                01/01/2021 à 12:00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Informations personnelles</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                                <input type="text" name="name" id="name" value="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                                <input type="email" name="email" id="email" value="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="text" name="phone" id="phone" value="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="birth_date" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                                <input type="date" name="birth_date" id="birth_date" value="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Adresse</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                            <div class="sm:col-span-6">
                                <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" name="address" id="address" value="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                                <input type="text" name="postal_code" id="postal_code" value="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                                <input type="text" name="city" id="city" value="" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                            
                            <div class="sm:col-span-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Pays</label>
                                <select id="country" name="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Sélectionner un pays</option>
                                    <option value="FR">France</option>
                                    <option value="BE">Belgique</option>
                                    <option value="CH">Suisse</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="CA">Canada</option>
                                </select>
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Gestion du mot de passe</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <p class="text-sm text-gray-500">Laisser les champs vides pour conserver le mot de passe actuel.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-6 gap-6">
                            <div class="sm:col-span-3">
                                <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                                <input type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <p class="mt-1 text-sm text-red-600"></p>
                            </div>
                            
                            <div class="sm:col-span-3">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <div class="flex items-start mt-4">
                                <div class="flex items-center h-5">
                                    <input id="send_password_notification" name="send_password_notification" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="send_password_notification" class="font-medium text-gray-700">Envoyer une notification</label>
                                    <p class="text-gray-500">Envoyer un email à l'utilisateur pour l'informer du changement de mot de passe.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Statut du compte</h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="pending">En attente</option>
                                <option value="blocked">Bloqué</option>
                            </select>
                            <p class="mt-1 text-sm text-red-600"></p>
                        </div>
                        
                        <div>
                            <label for="status_reason" class="block text-sm font-medium text-gray-700">Raison du changement (optionnel)</label>
                            <textarea id="status_reason" name="status_reason" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            <p class="mt-1 text-sm text-red-600"></p>
                        </div>
                        
                        <div class="flex items-start mt-4">
                            <div class="flex items-center h-5">
                                <input id="send_status_notification" name="send_status_notification" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="send_status_notification" class="font-medium text-gray-700">Envoyer une notification</label>
                                <p class="text-gray-500">Envoyer un email à l'utilisateur pour l'informer du changement de statut.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar-preview');
        const avatarPlaceholder = document.getElementById('avatar-placeholder');
        
        avatarInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                    avatarPreview.classList.remove('hidden');
                    
                    if (avatarPlaceholder) {
                        avatarPlaceholder.classList.add('hidden');
                    }
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        const removeAvatarBtn = document.getElementById('remove-avatar');
        const removeAvatarInput = document.getElementById('remove_avatar');
        
        if (removeAvatarBtn) {
            removeAvatarBtn.addEventListener('click', function() {
                avatarPreview.classList.add('hidden');
                avatarPlaceholder.classList.remove('hidden');
                avatarInput.value = '';
                removeAvatarInput.value = '1';
            });
        }
    });
</script>
@endpush