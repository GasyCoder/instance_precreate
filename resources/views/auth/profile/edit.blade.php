{{-- resources/views/profile/edit.blade.php --}}
<x-main-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-8"> {{-- Réduit à max-w-3xl --}}
            <!-- En-tête -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Profil</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Mettez à jour vos informations personnelles
                </p>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')
                <!-- Informations personnelles -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 space-y-6">
                        <div class="flex items-center border-b border-gray-200 dark:border-gray-700 pb-4">
                            <svg class="w-6 h-6 text-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informations personnelles</h2>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                            <div class="sm:col-span-1">
                                <label for="civilite" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Civilité
                                </label>
                                <select name="civilite" id="civilite"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                    <option value="mr" {{ old('civilite', $profile->civilite) === 'mr' ? 'selected' : '' }}>Mr.</option>
                                    <option value="mme" {{ old('civilite', $profile->civilite) === 'mme' ? 'selected' : '' }}>Mme</option>
                                    <option value="mlle" {{ old('civilite', $profile->civilite) === 'mlle' ? 'selected' : '' }}>Mlle</option>
                                </select>
                                <x-input-error for="civilite" class="mt-1" />
                            </div>

                            <div class="sm:col-span-2">
                                <label for="fname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Prénom
                                </label>
                                <input type="text" name="fname" id="fname" value="{{ old('fname', $profile->fname) }}"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                <x-input-error for="fname" class="mt-1" />
                            </div>

                            <div class="sm:col-span-3">
                                <label for="lname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nom
                                </label>
                                <input type="text" name="lname" id="lname" value="{{ old('lname', $profile->lname) }}"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                <x-input-error for="lname" class="mt-1" />
                            </div>

                            <div class="sm:col-span-6">
                                <label for="telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Téléphone
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $profile->telephone) }}"
                                        class="block w-full pl-10 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                </div>
                                <x-input-error for="telephone" class="mt-1" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adresse -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 space-y-6">
                        <div class="flex items-center border-b border-gray-200 dark:border-gray-700 pb-4">
                            <svg class="w-6 h-6 text-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Adresse</h2>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Adresse complète
                                </label>
                                <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $profile->adresse) }}"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                <x-input-error for="adresse" class="mt-1" />
                            </div>

                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                                <div>
                                    <label for="zipcode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Code postal
                                    </label>
                                    <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode', $profile->zipcode) }}"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                    <x-input-error for="zipcode" class="mt-1" />
                                </div>

                                <div>
                                    <label for="ville" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Ville
                                    </label>
                                    <input type="text" name="ville" id="ville" value="{{ old('ville', $profile->ville) }}"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                    <x-input-error for="ville" class="mt-1" />
                                </div>

                                <div>
                                    <label for="pays" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Pays
                                    </label>
                                    <input type="text" name="pays" id="pays" value="{{ old('pays', $profile->pays) }}"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">
                                    <x-input-error for="pays" class="mt-1" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 space-y-6">
                        <div class="flex items-center border-b border-gray-200 dark:border-gray-700 pb-4">
                            <svg class="w-6 h-6 text-primary-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Description</h2>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    À propos de moi
                                </label>
                                <textarea name="bio" id="bio" rows="4"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200">{{ old('bio', $profile->bio) }}</textarea>
                                <x-input-error for="bio" class="mt-1" />
                            </div>

                            <div class="flex items-start space-x-3 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" name="is_public" id="is_public" value="1"
                                        {{ old('is_public', $profile->is_public) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500 transition duration-200">
                                </div>
                                <div>
                                    <label for="is_public" class="text-sm font-medium text-gray-900 dark:text-white">Profil public</label>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Rendre votre profil visible pour les autres utilisateurs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 shadow-sm transition-all duration-200 hover:shadow-md space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Enregistrer les modifications</span>
                    </button>
                </div>
            </form>

            @if(session('status'))
            <div id="notification" class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Notification
        const notification = document.getElementById('notification');
        if (notification) {
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        // Formatage téléphone
        const phoneInput = document.getElementById('telephone');
        phoneInput.addEventListener('input', function(e) {
            let phone = e.target.value.replace(/\D/g, '');
            if (phone.length > 14) phone = phone.substring(0, 14);
            if (phone.length >= 2) {
                phone = phone.match(new RegExp('.{1,2}', 'g')).join(' ');
            }
            e.target.value = phone;
        });
    </script>
    @endpush
</x-main-layout>
