<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    <x-header-nav />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Contenu principal --}}
        <div class="grid grid-cols-12 gap-8">
            {{-- Sidebar - Liste des organisations --}}
            <div class="col-span-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-medium text-gray-900 dark:text-gray-100">Mes organisations</h2>
                            <span class="bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 text-xs font-bold px-2.5 py-0.5 rounded-xl">
                                {{ $entreprises ? $entreprises->count() : 0 }}
                            </span>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-200 dark:divide-gray-700 max-h-[calc(100vh-16rem)] overflow-y-auto">
                        @if($entreprises && $entreprises->count() > 0)
                            @foreach($entreprises as $entreprise)
                                <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-medium">
                                            {{ substr($entreprise->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $entreprise->name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $entreprise->ville }}, {{ $entreprise->pays_nom }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Aucune organisation ajoutée
                                </div>
                            @endif
                    </div>
                </div>
                    @if($showTerminerButton)
                        <button type="button"
                            wire:click="terminer"
                            class="inline-flex items-center px-6 py-3 bg-green-600 dark:bg-green-700 text-white rounded-lg hover:bg-green-700 dark:hover:bg-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800 transition-all duration-200">
                            <span>Continuer vers l'espace de travail</span>
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @endif
            </div>

            {{-- Formulaire --}}
            <div class="col-span-8">
                {{-- Message d'information --}}
                @include('layouts.partials.message_create_organisation')

                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-700 dark:to-indigo-700 rounded-t-lg p-6 text-white">
                    <h2 class="text-xl font-semibold">Nouvelle organisation</h2>
                    <p class="mt-1 text-blue-100">
                        @if(!$entreprises || $entreprises->isEmpty())
                        Configurez votre première organisation.
                        @else
                            Ajoutez une nouvelle organisation ou continuez vers l'espace de travail.
                        @endif
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 border-t-0 rounded-b-lg">
                    <form wire:submit.prevent="store" class="p-6 space-y-6">
                        {{-- Nom de l'organisation --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom de l'organisation</label>
                            <div class="relative">
                                <input type="text" wire:model="name"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white pr-10 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400"
                                    placeholder="Ex: Space X">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>
                            @error('name') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                        </div>

                        {{-- NIF/SIREN et Téléphone --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">NIF ou SIREN</label>
                                <input type="text" wire:model="nif"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors"
                                    placeholder="Numéro fiscal">
                                @error('nif')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Téléphone</label>
                                <input type="tel" wire:model="phone"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors"
                                    placeholder="+261 xx xx xxx xx">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Nombre d'employés --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre d'employés</label>
                            <select wire:model="employees_count"
                                class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors">
                                <option value="">Sélectionnez</option>
                                <option value="0-5">0-5 employés</option>
                                <option value="1-10">1-10 employés</option>
                                <option value="11-50">11-50 employés</option>
                                <option value="51-200">51-200 employés</option>
                                <option value="201+">201+ employés</option>
                            </select>
                            @error('employees_count')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Adresse --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adresse complète</label>
                            <textarea wire:model="adresse" rows="3"
                                class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors"
                                placeholder="Adresse de l'entreprise"></textarea>
                            @error('adresse')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Ville et Pays --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ville</label>
                                <input type="text" wire:model="ville"
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors"
                                    placeholder="Ex: Antananarivo">
                                @error('ville')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pays</label>
                                <x-country-select :selected="$pays" class="mt-1" />
                                @error('pays')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Boutons d'action --}}
                        <div class="p-6 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700/50">
                            <div class="flex justify-between items-center">
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-blue-600 dark:bg-blue-700 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-all duration-200">
                                    <span>Ajouter l'organisation</span>
                                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
