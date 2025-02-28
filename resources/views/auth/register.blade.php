<x-main-layout>
    @push("styles")
        <style>
        /* Animation de transition */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        /* Animation de l'icône de chargement */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Focus styles personnalisés */
        .focus-within\:ring-2:focus-within {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        }

        /* Hover effect sur les boutons */
        .hover\:scale-\[1\.02\]:hover {
            transform: scale(1.02);
        }
        </style>
    @endpush

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-900">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo si vous en avez un -->
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                Créer un compte gratuit
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white dark:bg-gray-800 py-8 px-4 shadow-xl sm:rounded-xl sm:px-10 border border-gray-100 dark:border-gray-700">
                <!-- Registration Form -->
                <div>
                    <form class="mt-2 space-y-6" method="POST" action="{{ route('inscription') }}" id="registrationForm">
                        @csrf
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Adresse email
                            </label>
                            <div class="relative">
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 sm:text-sm transition-colors"
                                    value="{{ old('email') }}"
                                />
                                <div id="email-validation-icon" class="hidden absolute inset-y-0 right-0 flex items-center pr-3">
                                </div>
                            </div>
                            <div id="email-error" class="mt-1 text-sm text-red-600 dark:text-red-400 hidden"></div>
                            <x-input-error for="email" class="mt-1" />
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Mot de passe
                            </label>
                            <div class="relative">
                                <input id="password"
                                       name="password"
                                       type="password"
                                       required
                                       class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 sm:text-sm transition-colors" />
                                <button type="button"
                                        onclick="togglePasswordVisibility('password')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error for="password" class="mt-1" />
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Confirmer le mot de passe
                            </label>
                            <div class="relative">
                                <input id="password_confirmation"
                                       name="password_confirmation"
                                       type="password"
                                       required
                                       class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 sm:text-sm transition-colors" />
                                <button type="button"
                                        onclick="togglePasswordVisibility('password_confirmation')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error for="password_confirmation" class="mt-1" />
                        </div>

                        <div class="flex items-center">
                            <input id="terms"
                                   name="terms"
                                   type="checkbox"
                                   required
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 dark:border-gray-600 rounded" />
                            <label for="terms" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                J'accepte les <a href="{{ route('terms.show') }}" class="text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">conditions d'utilisation</a>
                                et la <a href="{{ route('policy.show') }}" class="text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">politique de confidentialité</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 dark:bg-primary-700 dark:hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition-all duration-200 ease-in-out transform hover:scale-[1.02]">
                                Créer mon compte
                            </button>
                        </div>
                    </form>
                </div>
                <p class="mt-3 text-center text-sm text-gray-600 dark:text-gray-400">
                    Déjà inscrit?
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleRegistrationForm() {
            const authOptions = document.getElementById('auth-options');
            const registrationForm = document.getElementById('registration-form');

            authOptions.classList.toggle('hidden');
            registrationForm.classList.toggle('hidden');
        }

        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        // Validation email en temps réel
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const emailValidationIcon = document.getElementById('email-validation-icon');

        let typingTimer;
        const doneTypingInterval = 500; // Délai avant validation (ms)

        emailInput.addEventListener('keyup', () => {
            clearTimeout(typingTimer);
            if (emailInput.value) {
                typingTimer = setTimeout(validateEmail, doneTypingInterval);
            }
        });

        function validateEmail() {
            const email = emailInput.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Réinitialisation des styles
            emailInput.classList.remove('border-red-500', 'border-green-500');
            emailError.classList.add('hidden');
            emailValidationIcon.innerHTML = '';

            if (!email) {
                return;
            }

            if (!emailRegex.test(email)) {
                // Email invalide
                emailInput.classList.add('border-red-500');
                emailError.classList.remove('hidden');
                emailError.textContent = "L'adresse email n'est pas valide";
                emailValidationIcon.innerHTML = `
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                `;
            } else {
                // Vérification du domaine de l'email
                const domain = email.split('@')[1];
                fetch(`https://dns.google/resolve?name=${domain}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.Status === 0 && data.Answer) {
                            // Domaine valide
                            emailInput.classList.add('border-green-500');
                            emailValidationIcon.innerHTML = `
                                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            `;
                        } else {
                            // Domaine invalide
                            emailInput.classList.add('border-red-500');
                            emailError.classList.remove('hidden');
                            emailError.textContent = "Le domaine de l'email n'existe pas";
                            emailValidationIcon.innerHTML = `
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            `;
                        }
                    })
                    .catch(() => {
                        // Erreur de vérification
                        emailInput.classList.add('border-red-500');
                        emailError.classList.remove('hidden');
                        emailError.textContent = "Impossible de vérifier le domaine de l'email";
                    });
            }
        }

        // Validation du formulaire avant soumission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;

            let isValid = true;
            let errors = [];

            // Validation de l'email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                isValid = false;
                errors.push("L'adresse email n'est pas valide");
            }

            // Validation du mot de passe
            if (password.length < 8) {
                isValid = false;
                errors.push("Le mot de passe doit contenir au moins 8 caractères");
            }

            if (password !== passwordConfirmation) {
                isValid = false;
                errors.push("Les mots de passe ne correspondent pas");
            }

            // Validation des conditions
            if (!terms) {
                isValid = false;
                errors.push("Vous devez accepter les conditions d'utilisation");
            }

            // Affichage des erreurs ou soumission du formulaire
            if (!isValid) {
                const errorContainer = document.createElement('div');
                errorContainer.className = 'bg-red-50 border-l-4 border-red-500 p-4 my-4';
                errorContainer.innerHTML = `
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Erreurs de validation :</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                ${errors.map(error => `<li>${error}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                `;

                // Supprime l'ancien conteneur d'erreurs s'il existe
                const oldErrorContainer = document.querySelector('.bg-red-50');
                if (oldErrorContainer) {
                    oldErrorContainer.remove();
                }

                // Ajoute le nouveau conteneur d'erreurs avant le formulaire
                document.getElementById('registrationForm').insertBefore(errorContainer, document.getElementById('registrationForm').firstChild);
            } else {
                // Soumet le formulaire si tout est valide
                this.submit();
            }
        });

        // Animation de chargement pour le bouton de soumission
        document.getElementById('registrationForm').addEventListener('submit', function() {
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Création du compte...
            `;
        });
    </script>
    @endpush
</x-main-layout>
