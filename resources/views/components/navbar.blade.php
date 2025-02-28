    <!-- Barre de navigation -->
    <nav class="fixed inset-x-0 top-0 z-50 backdrop-blur-lg bg-light-bg/80 dark:bg-dark-bg/80 border-b border-light-border dark:border-dark-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-3 group">
                        <img class="h-9 w-auto transform transition group-hover:scale-105"
                             src="{{ asset('client/assets/img/logo/logo.png') }}"
                             alt="Logo">
                        <span class="font-display font-semibold text-lg bg-gradient-to-r from-primary-500 to-primary-600 bg-clip-text text-transparent">
                            ERP INNOV
                        </span>
                    </a>
                </div>

                <!-- Right Navigation -->
                <div class="flex items-center gap-6">
                    @auth
                        <button
                            id="darkModeToggle"
                            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-dark-bg/50 transition-colors">

                            <!-- Icône Lune (Mode Clair) -->
                            <svg
                                id="moon-icon"
                                class="w-6 h-6 text-light-text dark:text-dark-text"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                style="display: none;">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>

                            <!-- Icône Soleil (Mode Sombre) -->
                            <svg
                                id="sun-icon"
                                class="w-6 h-6 text-dark-text dark:text-dark-text"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                style="display: none;">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </button>
                        <!-- Notifications -->
                        {{-- <button class="relative p-2 rounded-full hover:bg-gray-100 dark:hover:bg-dark-bg/50 transition-colors">
                            <span class="absolute top-1 right-1 h-2 w-2 rounded-full bg-primary-500"></span>
                            <svg class="w-6 h-6 text-light-text dark:text-dark-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button> --}}

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                    @keydown.escape.window="open = false"
                                    class="flex items-center gap-3 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-dark-bg/50 transition-colors">
                                <img class="h-9 w-9 rounded-full object-cover ring-2 ring-primary-200 dark:ring-primary-700"
                                    src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->profile?->fname ?? Auth::user()->name }}">
                                <span class="hidden md:block text-sm font-medium text-light-text dark:text-dark-text">
                                    {{ Auth::user()->profile?->fname ?? Auth::user()->name }}
                                </span>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open"
                                 x-cloak
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 rounded-2xl bg-light-bg dark:bg-dark-bg shadow-lg ring-1 ring-light-border dark:ring-dark-border divide-y divide-light-border dark:divide-dark-border">
                                <div class="px-2 py-2">
                                    <a href="{{ route('profile.show') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-dark-bg/50 text-light-text dark:text-dark-text">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Mon Profil
                                    </a>
                                    @if(auth()->user()->hasVerifiedEmail())
                                        @php
                                            // Vérifier si l'utilisateur a déjà au moins une entreprise
                                            $hasCompanies = auth()->user()->entreprises()->exists();
                                        @endphp

                                        <a href="{{ route('entreprise.create') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-dark-bg/50 text-light-text dark:text-dark-text">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($hasCompanies)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" class="text-primary-500"/>
                                                @endif
                                            </svg>
                                            @if($hasCompanies)
                                                Mes Entreprises
                                            @else
                                                Créer une entreprise
                                            @endif
                                        </a>
                                    @endif
                                </div>
                                <div class="px-2 py-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 text-sm rounded-lg hover:bg-red-50 dark:hover:bg-red-500/20 text-red-600 dark:text-red-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="flex items-center gap-4">
                        <button
                        id="darkModeToggle"
                        class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-dark-bg/50 transition-colors">

                        <!-- Icône Lune (Mode Clair) -->
                        <svg
                            id="moon-icon"
                            class="w-6 h-6 text-light-text dark:text-dark-text"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            style="display: none;">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>

                        <!-- Icône Soleil (Mode Sombre) -->
                        <svg
                            id="sun-icon"
                            class="w-6 h-6 text-dark-text dark:text-dark-text"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            style="display: none;">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                        <a href="{{ route('login') }}"
                            class="text-light-text dark:text-dark-text hover:text-primary-600 dark:hover:text-primary-400 px-4 py-2 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-dark-bg/50 transition-colors">
                            Se connecter
                        </a>
                        <a href="{{ route('inscription') }}"
                            class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 text-sm font-medium rounded-2xl transition-colors shadow-sm hover:shadow-md hover:transform hover:-translate-y-1">
                            S'inscrire
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
