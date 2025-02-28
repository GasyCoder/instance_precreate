{{-- resources/views/auth/verify-otp.blade.php --}}
<x-main-layout>
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <div class="h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                Vérification de votre compte
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400 max-w-sm mx-auto">
                Un code de vérification à 6 chiffres a été envoyé à votre adresse email
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white dark:bg-gray-800 py-8 px-4 shadow sm:rounded-xl sm:px-10 border border-gray-100 dark:border-gray-700">
                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/20 rounded-lg p-4 flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400 dark:text-green-300 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 text-sm font-medium text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-900/20 rounded-lg p-4 flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 dark:text-red-300 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('verification.verify') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="otp_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Code de vérification
                        </label>

                        <div class="mt-1">
                            {{-- Champ caché pour stocker la valeur complète du code OTP --}}
                            <input type="hidden" name="otp" id="otp" value="{{ old('otp') }}">

                            <div class="flex justify-between items-center gap-2">
                                @for ($i = 1; $i <= 6; $i++)
                                <div class="w-full">
                                    <input type="text"
                                           inputmode="numeric"
                                           id="otp_{{ $i }}"
                                           maxlength="1"
                                           autocomplete="off"
                                           class="appearance-none block w-full py-4 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm text-center text-xl font-mono font-semibold focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:border-primary-500 transition duration-150"
                                           placeholder="•"
                                           data-otp-input>
                                </div>
                                @endfor
                            </div>
                        </div>
                        @error('otp')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Nous vous avons envoyé un code à 6 chiffres par email. Ce code est valide pendant 10 minutes.</p>
                    </div>

                    {{-- JavaScript pour gérer les cases OTP --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const inputs = document.querySelectorAll('[data-otp-input]');
                            const form = document.querySelector('form');
                            const otpInput = document.getElementById('otp');

                            // Focus sur le premier champ au chargement
                            setTimeout(() => inputs[0].focus(), 100);

                            inputs.forEach((input, index) => {
                                // Autorise seulement les chiffres
                                input.addEventListener('input', function(e) {
                                    const value = e.target.value;

                                    // Accepter uniquement les chiffres
                                    if (!/^\d*$/.test(value)) {
                                        e.target.value = '';
                                        return;
                                    }

                                    // Déplacer le focus vers la case suivante si remplie
                                    if (value.length === 1 && index < inputs.length - 1) {
                                        inputs[index + 1].focus();
                                    }

                                    // Mettre à jour le champ caché avec tous les chiffres
                                    updateHiddenField();
                                });

                                // Navigation avec les touches du clavier
                                input.addEventListener('keydown', function(e) {
                                    if (e.key === 'Backspace' && input.value === '' && index > 0) {
                                        // Retour au champ précédent si Backspace est pressé dans un champ vide
                                        inputs[index - 1].focus();
                                    } else if (e.key === 'ArrowLeft' && index > 0) {
                                        inputs[index - 1].focus();
                                    } else if (e.key === 'ArrowRight' && index < inputs.length - 1) {
                                        inputs[index + 1].focus();
                                    }
                                });

                                // Support pour coller un code complet
                                input.addEventListener('paste', function(e) {
                                    e.preventDefault();
                                    const pasteData = e.clipboardData.getData('text').trim();

                                    if (/^\d+$/.test(pasteData) && pasteData.length <= inputs.length) {
                                        for (let i = 0; i < pasteData.length; i++) {
                                            if (i + index < inputs.length) {
                                                inputs[i + index].value = pasteData[i];
                                            }
                                        }

                                        // Focus sur le dernier champ ou le suivant après la séquence
                                        const focusIndex = Math.min(index + pasteData.length, inputs.length - 1);
                                        inputs[focusIndex].focus();

                                        // Mettre à jour le champ caché
                                        updateHiddenField();
                                    }
                                });
                            });

                            // Fonction pour mettre à jour le champ caché avec la valeur complète
                            function updateHiddenField() {
                                otpInput.value = Array.from(inputs).map(input => input.value).join('');
                            }

                            // Pré-remplir les champs si une valeur existe déjà (par exemple après erreur de validation)
                            if (otpInput.value) {
                                const digits = otpInput.value.split('');
                                digits.forEach((digit, i) => {
                                    if (i < inputs.length) {
                                        inputs[i].value = digit;
                                    }
                                });
                            }
                        });
                    </script>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-700 dark:hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Vérifier mon compte
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Vous n'avez pas reçu de code?</span>
                        </div>
                    </div>

                    <form action="{{ route('verification.resend') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Renvoyer le code
                        </button>
                    </form>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300 font-medium flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour à la connexion
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
