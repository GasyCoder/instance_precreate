<!-- resources/views/instance/create.blade.php -->
<div class="min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-primary-50 via-white to-gray-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <x-header-nav />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Form Section -->
            <div class="lg:col-span-2">
                @if($newInstanceInfo)
                    @include('livewire.client.messages.infocreated')
                @else
                    <div class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-700/50">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 via-transparent to-transparent dark:from-primary-400/10"></div>
                        <div class="absolute right-0 top-0 h-px w-32 bg-gradient-to-l from-primary-500/50 to-transparent"></div>
                        <div class="absolute left-0 bottom-0 h-px w-32 bg-gradient-to-r from-primary-500/50 to-transparent"></div>

                        @unless($showPlanSelection)
                            <div class="relative">
                                <!-- Enhanced Header -->
                                <div class="relative px-6 sm:px-8 py-8">
                                    <!-- Decorative background -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-primary-50/50 via-transparent to-transparent dark:from-primary-900/20"></div>

                                    <!-- Border decoration -->
                                    <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-primary-500/20 to-transparent"></div>

                                    <div class="relative flex items-start gap-5 sm:gap-6">
                                        <!-- Icon Container with enhanced styling -->
                                        <div class="relative flex-shrink-0">
                                            <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl blur-sm opacity-50"></div>
                                            <div class="relative h-9 w-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 p-0.5 shadow-lg transform transition-transform hover:scale-105">
                                                <div class="h-full w-full rounded-xl bg-white dark:bg-gray-800 flex items-center justify-center transition-colors">
                                                    <svg class="w-6 h-6 text-primary-500 transform transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Content with enhanced typography -->
                                        <div class="flex-1">
                                            <div class="relative">
                                                <h2 class="text-xl sm:text-1xl font-bold">
                                                    <span class="inline-block bg-gradient-to-r from-primary-600 via-primary-500 to-primary-400 bg-clip-text text-transparent pb-1">
                                                        Créez votre espace de travail
                                                    </span>
                                                </h2>
                                                <!-- Decorative underline -->
                                                <div class="absolute bottom-0 left-0 w-24 h-px bg-gradient-to-r from-primary-500/50 to-transparent"></div>
                                            </div>

                                            <div class="mt-2 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                <svg class="w-4 h-4 text-primary-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                                <p class="leading-relaxed">
                                                    Configurez votre environnement professionnel en quelques étapes simples
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Enhanced Form -->
                                <div class="p-8 space-y-8">

                                <form wire:submit.prevent="store" class="space-y-8">
                                <!-- Avant le formulaire principal, ajoutons le sélecteur de type -->
                                    <div class="mb-8">
                                        <div class="grid grid-cols-2 gap-4 mb-8">
                                            <!-- Option Auto -->
                                            <label class="relative group cursor-pointer">
                                                <input type="radio" wire:model.live="creationType" value="auto" class="peer sr-only">
                                                <div class="p-4 rounded-xl border-2 transition-all duration-200
                                                    peer-checked:border-primary-500
                                                    dark:peer-checked:border-primary-400 dark:peer-checked:bg-primary-900/10
                                                    hover:bg-gray-50 dark:hover:bg-gray-800/50
                                                    border-gray-200 dark:border-gray-700">
                                                    <div class="flex items-center gap-3">
                                                        <div class="shrink-0 rounded-lg bg-primary-100 dark:bg-primary-900/30 p-2">✨</div>
                                                        <div>
                                                            <h3 class="font-medium text-gray-900 dark:text-gray-100 group-hover:text-gray-900 dark:group-hover:text-gray-100">Générer automatiquement</h3>
                                                            <p class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-400">Basé sur votre entreprise (ex:{{ $autoName ?: 'nom-généré' }})</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                            <!-- Option Manuelle -->
                                            <label class="relative group cursor-pointer">
                                                <input type="radio" wire:model.live="creationType" value="manual" class="peer sr-only">
                                                <div class="p-4 rounded-xl border-2 transition-all duration-200
                                                peer-checked:border-primary-500
                                                dark:peer-checked:border-primary-400 dark:peer-checked:bg-primary-900/10
                                                hover:bg-gray-50 dark:hover:bg-gray-800/50
                                                border-gray-200 dark:border-gray-700">
                                                    <div class="flex items-center gap-3">
                                                        <div class="shrink-0 rounded-lg bg-primary-100 p-2">
                                                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h3 class="font-medium text-gray-900 dark:text-gray-100 group-hover:text-gray-900 dark:group-hover:text-gray-100">Création Manuelle</h3>
                                                            <p class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-400">Personnalisez votre nom ({{ $name ?: 'nom-personnalisé' }})</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Nom de l'instance -->
                                    <div class="space-y-4">
                                        @if($creationType === 'manual')
                                        <div class="flex justify-between items-center">
                                            <label class="block text-base font-medium text-gray-900 dark:text-white">
                                                Nom de l'instance
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <span class="text-sm text-gray-500">
                                                {{ $creationType === 'auto' ? 'Nom généré automatiquement' : 'Votre nom d\'instance personnalisé' }}
                                            </span>
                                        </div>
                                            <div class="group">
                                                <div class="flex overflow-hidden rounded-xl border border-gray-200 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition-all duration-200">
                                                    <div class="flex-1">
                                                        <div class="flex items-center">
                                                            <div class="flex items-center pl-4 text-gray-500">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                                </svg>
                                                            </div>
                                                            <input type="text"
                                                                wire:model="name"
                                                                class="flex-1 px-4 py-3 bg-transparent border-0 text-gray-900 placeholder-gray-400 focus:ring-0 sm:text-sm"
                                                                placeholder="votreinstance">
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center px-4 bg-gray-50 border-l border-gray-200 text-sm text-gray-500">
                                                        .erpinnov.com
                                                    </div>
                                                </div>
                                                @error('name')
                                                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                        </svg>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        @else
                                        <div class="mt-2 text-sm text-yellow-600">
                                            Le nom de votre instance sera généré automatiquement après la sélection de l'entreprise.
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Sélection de l'entreprise -->
                                    <div class="space-y-4">
                                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between">
                                            <label class="block text-base font-medium text-gray-900 dark:text-white">
                                                Entreprise associée <span class="text-red-500">*</span>
                                                <p class="text-sm text-gray-500">Cette instance sera liée à l'entreprise sélectionnée</p>
                                            </label>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach($entreprises as $entreprise)
                                                <label class="relative flex items-center justify-between p-4 border rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200
                                                            focus-within:ring-2 focus-within:ring-primary-500 focus-within:border-primary-500
                                                            {{ $entreprise_id == $entreprise->id ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/10' : 'border-gray-200 dark:border-gray-700' }}">
                                                    {{-- Contenu gauche --}}
                                                    <div class="flex items-center space-x-3">
                                                        {{-- Logo/Initial --}}
                                                        <div class="flex-shrink-0 h-8 w-8 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-medium">
                                                            {{ Str::substr($entreprise->name, 0, 1) }}
                                                        </div>

                                                        {{-- Informations --}}
                                                        <div class="flex flex-col">
                                                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ $entreprise->name }}
                                                            </span>
                                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                                {{ $entreprise->ville }}{{ $entreprise->pays ? ', ' . $entreprise->pays : '' }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    {{-- Radio button à droite --}}
                                                    <div class="flex-shrink-0 ml-4">
                                                        <input type="radio"
                                                            wire:model.live="entreprise_id"
                                                            name="entreprise_id"
                                                            value="{{ $entreprise->id }}"
                                                            class="h-4 w-4 text-primary-600 border-gray-300 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700">
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('entreprise_id')
                                            <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Affichage du pays -->
                                    @if($entreprise_id)
                                    <div wire:loading.class="opacity-50"
                                        wire:target="entreprise_id"
                                        class="">
                                        <div class="flex items-center gap-4">
                                            <div class="relative">
                                                <div class="h-8 w-8 rounded-xl overflow-hidden ring-2 ring-white shadow-lg">
                                                    <img src="{{ asset('client/assets/img/flags/' . ($selectedPays == 'Madagascar' ? '0.png' : '1.png')) }}"
                                                        alt="{{ $selectedPays }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                <div class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full bg-green-500 border-2 border-white"></div>
                                            </div>

                                            <div>
                                                <span class="block text-base font-medium text-gray-900 dark:text-white">
                                                    {{ $selectedPays }}
                                                </span>
                                                <div class="flex items-center mt-1">
                                                    <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span class="text-sm text-gray-500">Localisation de l'entreprise</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @endif

                                <!-- Actions -->
                                <div class="flex items-center justify-between pt-8 mt-8 border-t border-gray-200 dark:border-gray-700/60">
                                <a href="{{ route('instance.create')}}" wire:navigate
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 dark:text-white hover:text-gray-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Réinitialiser
                                </a>

                                <div class="flex items-center gap-3">
                                    <x-button-create/>
                                </div>
                                </div>

                                </form>

                                </div>
                            </div>
                        @else
                            <div class="p-8">
                                @include('livewire.payment.free_expired')
                            </div>
                        @endif

                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            @include('livewire.client.sections.sidebar')
        </div>
    </div>
</div>
