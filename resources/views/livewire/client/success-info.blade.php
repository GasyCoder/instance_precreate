{{-- Vue de succès avec préfixe tw- --}}
<div class="tw-space-y-6">
    {{-- En-tête de succès --}}
    <div class="tw-text-center">
        <div class="tw-inline-flex tw-rounded-full tw-bg-success-50 tw-p-3">
            <svg class="tw-h-16 tw-w-16 tw-text-success-600" fill="none" viewBox="0 0 48 48" stroke="currentColor">
                <circle cx="24" cy="24" r="20" stroke-width="2"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 24l6 6 12-12"/>
            </svg>
        </div>
        <h2 class="tw-mt-4 tw-text-2xl tw-font-bold tw-text-gray-900">Instance créée avec succès !</h2>
        <p class="tw-mt-2 tw-text-gray-600">Voici les informations de connexion de votre nouvelle instance</p>
    </div>

    {{-- Grille d'informations --}}
    <div class="tw-bg-gray-50 tw-rounded-xl tw-p-6">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
            {{-- Nom de l'instance --}}
            <div class="tw-flex tw-items-start tw-gap-4">
                <div class="tw-flex-shrink-0 tw-h-12 tw-w-12 tw-bg-primary-100 tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                    <svg class="tw-h-6 tw-w-6 tw-text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </div>
                <div>
                    <p class="tw-text-sm tw-font-medium tw-text-gray-500">Nom de l'instance</p>
                    <p class="tw-mt-1 tw-text-lg tw-font-semibold tw-text-gray-900">{{ $newInstanceInfo['name'] }}</p>
                </div>
            </div>

            {{-- Login --}}
            <div class="tw-flex tw-items-start tw-gap-4">
                <div class="tw-flex-shrink-0 tw-h-12 tw-w-12 tw-bg-primary-100 tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                    <svg class="tw-h-6 tw-w-6 tw-text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="tw-text-sm tw-font-medium tw-text-gray-500">Login</p>
                    <p class="tw-mt-1 tw-text-lg tw-font-semibold tw-text-gray-900">{{ $newInstanceInfo['login'] }}</p>
                </div>
            </div>

            {{-- Mot de passe --}}
            <div class="tw-flex tw-items-start tw-gap-4">
                <div class="tw-flex-shrink-0 tw-h-12 tw-w-12 tw-bg-primary-100 tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                    <svg class="tw-h-6 tw-w-6 tw-text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <div class="tw-flex-1">
                    <p class="tw-text-sm tw-font-medium tw-text-gray-500">Mot de passe</p>
                    <div class="tw-mt-1 tw-flex tw-items-center tw-gap-2">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            value="{{ $newInstanceInfo['password'] }}"
                            class="tw-flex-1 tw-bg-transparent tw-border-0 tw-text-lg tw-font-semibold tw-text-gray-900 focus:tw-ring-0"
                            readonly
                        >
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="tw-p-2 tw-rounded-lg hover:tw-bg-gray-100 tw-text-gray-500 hover:tw-text-gray-700 tw-transition-colors"
                        >
                            <svg class="tw-h-5 tw-w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    x-show="!showPassword"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                                <path
                                    x-show="showPassword"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7 1.274-4.057 5.064-7 9.543-7 4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.563 3.029M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"
                                />
                            </svg>
                        </button>
                        <button
                            type="button"
                            @click="copyToClipboard('{{ $newInstanceInfo['password'] }}', 'password')"
                            class="tw-p-2 tw-rounded-lg hover:tw-bg-gray-100 tw-text-gray-500 hover:tw-text-gray-700 tw-transition-colors"
                        >
                            <svg class="tw-h-5 tw-w-5" :class="{ 'tw-text-success-500': copyFeedback.password }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    x-show="!copyFeedback.password"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                />
                                <path
                                    x-show="copyFeedback.password"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- URL --}}
            <div class="tw-flex tw-items-start tw-gap-4">
                <div class="tw-flex-shrink-0 tw-h-12 tw-w-12 tw-bg-primary-100 tw-rounded-lg tw-flex tw-items-center tw-justify-center">
                    <svg class="tw-h-6 tw-w-6 tw-text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <div class="tw-flex-1">
                    <p class="tw-text-sm tw-font-medium tw-text-gray-500">URL de connexion</p>
                    <div class="tw-mt-1 tw-flex tw-items-center tw-gap-2">
                        <a
                            href="{{ $newInstanceInfo['url'] }}"
                            target="_blank"
                            class="tw-flex-1 tw-text-primary-600 hover:tw-text-primary-700 tw-text-lg tw-font-semibold tw-truncate"
                        >
                            {{ $newInstanceInfo['url'] }}
                        </a>
                        <button
                            type="button"
                            @click="copyToClipboard('{{ $newInstanceInfo['url'] }}', 'url')"
                            class="tw-p-2 tw-rounded-lg hover:tw-bg-gray-100 tw-text-gray-500 hover:tw-text-gray-700 tw-transition-colors"
                        >
                            <svg class="tw-h-5 tw-w-5" :class="{ 'tw-text-success-500': copyFeedback.url }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    x-show="!copyFeedback.url"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                />
                                <path
                                    x-show="copyFeedback.url"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Message d'avertissement --}}
        <div class="tw-mt-6 tw-flex tw-items-start tw-gap-3 tw-p-4 tw-bg-amber-50 tw-text-amber-700 tw-rounded-lg">
            <svg class="tw-h-5 tw-w-5 tw-flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p class="tw-text-sm">
                Veuillez sauvegarder ces informations dans un endroit sûr. Vous les recevrez également par email.
            </p>
        </div>

        {{-- Bouton d'accès --}}
        <div class="tw-mt-6 tw-text-center">
            <a
                href="{{ $newInstanceInfo['url'] }}"
                class="tw-inline-flex tw-items-center tw-px-6 tw-py-3 tw-bg-primary-600 tw-text-white tw-font-semibold tw-rounded-lg hover:tw-bg-primary-700 tw-transition-colors"
                target="_blank"
            >
                Accéder à mon instance
                <svg class="tw-ml-2 tw-h-5 tw-w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>
    </div>
</div>
