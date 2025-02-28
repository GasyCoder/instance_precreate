<!-- Affichage des informations après création -->
{{-- livewire.client.messages.infocreated --}}
<div class="modal-body p-0 overflow-hidden" x-data="{
    showPassword: false,
    copyFeedback: {
        password: false,
        url: false
    },
    async copyToClipboard(text, type) {
        try {
            await navigator.clipboard.writeText(text);
            this.copyFeedback[type] = true;
            setTimeout(() => {
                this.copyFeedback[type] = false;
            }, 1500);
        } catch (err) {
            console.error('Erreur de copie:', err);
        }
    }
}">
    <!-- En-tête avec dégradé et icône de succès -->
    <div class="relative bg-gradient-to-br from-indigo-500 to-purple-600 p-8 text-white">
        <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M20 6H12L10 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V8C22 6.9 21.1 6 20 6Z"/>
            </svg>
        </div>

        <div class="flex items-center mb-4">
            <div class="w-16 h-16 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center mr-5 shadow-lg">
                <svg class="w-8 h-8 text-white" viewBox="0 0 24 24">
                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" fill="currentColor"/>
                </svg>
            </div>
            <div>
                <h4 class="text-2xl font-bold">Instance créée avec succès !</h4>
                <p class="text-white text-opacity-80 mt-1">Voici vos identifiants de connexion</p>
            </div>
        </div>
    </div>

    <!-- Contenu principal avec shadow inset -->
    <div class="p-6 md:p-8 bg-white dark:bg-gray-800">
        <!-- Carte d'informations -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md divide-y divide-gray-200 dark:divide-gray-600">
            <!-- Instance name -->
            <div class="flex items-center p-4">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-medium">Nom de l'instance</p>
                    <p class="text-gray-800 dark:text-white font-semibold text-base">{{ $newInstanceInfo['name'] }}</p>
                </div>
            </div>

            <!-- URL -->
            <div class="flex items-center p-4">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-medium">URL de connexion</p>
                    <div class="flex items-center gap-2 mt-1">
                        <a href="{{ $newInstanceInfo['url'] }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium text-sm truncate">
                            {{ $newInstanceInfo['url'] }}
                        </a>
                        <button @click="copyToClipboard('{{ $newInstanceInfo['url'] }}', 'url')"
                            class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                            :class="{ 'text-green-500': copyFeedback.url, 'text-gray-500 dark:text-gray-400': !copyFeedback.url }">
                            <svg x-show="!copyFeedback.url" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2"/>
                            </svg>
                            <svg x-show="copyFeedback.url" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Login -->
            <div class="flex items-center p-4">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-medium">Login</p>
                    <p class="text-gray-800 dark:text-white font-semibold text-base">{{ $newInstanceInfo['login'] }}</p>
                </div>
            </div>

            <!-- Mot de passe -->
            <div class="flex items-center p-4">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-medium">Mot de passe</p>
                    <div class="flex items-center gap-2 mt-1">
                        <div class="flex-1 bg-gray-100 dark:bg-gray-800 rounded px-3 py-1.5 max-w-xs">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                value="{{ $newInstanceInfo['password'] }}"
                                class="bg-transparent border-none p-0 font-medium text-gray-900 dark:text-white outline-none w-full"
                                readonly>
                        </div>
                        <button
                            @click="showPassword = !showPassword"
                            class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                            :class="showPassword ? 'text-indigo-500' : 'text-gray-500 dark:text-gray-400'">
                            <svg x-show="!showPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                        <button
                            @click="copyToClipboard('{{ $newInstanceInfo['password'] }}', 'password')"
                            class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
                            :class="{ 'text-green-500': copyFeedback.password, 'text-gray-500 dark:text-gray-400': !copyFeedback.password }">
                            <svg x-show="!copyFeedback.password" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2"/>
                            </svg>
                            <svg x-show="copyFeedback.password" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerte améliorée -->
        <div class="mt-6 bg-amber-50 dark:bg-amber-900 border-l-4 border-amber-400 dark:border-amber-500 rounded-lg overflow-hidden">
            <div class="p-4 flex items-start">
                <svg class="w-5 h-5 text-amber-500 dark:text-amber-400 mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="text-sm text-amber-800 dark:text-amber-200">
                        Veuillez sauvegarder ces informations dans un endroit sûr. Vous les recevrez également par email.
                    </p>
                </div>
            </div>
        </div>

        <!-- Bouton d'accès -->
        <div class="mt-8 flex flex-col sm:flex-row sm:justify-between gap-4">
            <a href="{{ $newInstanceInfo['url'] }}"
               target="_blank"
               class="flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Accéder à mon instance
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
            <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-sm flex items-center justify-center">
                Envoyer les informations par email
                <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
