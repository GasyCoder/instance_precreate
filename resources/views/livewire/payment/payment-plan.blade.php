<div>
    <div class="max-w-4xl mx-auto px-4 pb-8 py-16 mt-6">
        <!-- Header -->
        <div class="mb-3 text-center">
            <h2 class="text-xl font-normal text-gray-900 dark:text-white">Nos offres</h2>
            <p class="mt-0 text-base text-gray-500 dark:text-gray-400">Choisissez le plan qui correspond à vos besoins</p>
            <!-- Toggle Prix -->
            <div class="mt-0 inline-flex items-center bg-gray-100 dark:bg-gray-800 p-1 rounded-full">
                <button wire:click="setYearly(false)"
                        class="px-4 py-1.5 text-sm rounded-full transition-all {{ !$isYearly ? 'bg-white dark:bg-gray-700 shadow-sm' : '' }}">
                    Mensuel
                </button>
                <button wire:click="setYearly(true)"
                        class="px-4 py-1.5 text-sm rounded-full transition-all flex items-center gap-2 {{ $isYearly ? 'bg-white dark:bg-gray-700 shadow-sm' : '' }}">
                    Annuel
                    <span class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs px-2 py-0.5 rounded-full">-10%</span>
                </button>
            </div>
        </div>

        <!-- Plans -->
        <div class="space-y-3">
            @foreach($plans as $plan)
                <div class="group">
                    <!-- Plan Header -->
                    <div class="relative bg-white dark:bg-gray-800 rounded-xl transition-all duration-200
                            cursor-pointer overflow-hidden hover:shadow-md border border-gray-200 dark:border-gray-700
                            {{ $plan->name === 'Solo Standard' ? 'border-2 border-primary-600' : '' }}">
                        <!-- Content -->
                        <div class="relative flex items-start justify-between p-6">
                            <div>
                                <h3 class="text-xl font-normal text-gray-900 dark:text-white">{{ $plan->name }}</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $plan->description }}</p>
                                @if($plan->is_free)
                                    <span class="inline-block mt-2 bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Gratuit</span>
                                @endif
                                @if($plan->name === 'Solo Standard')
                                    <span class="inline-block mt-2 bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Populaire</span>
                                @endif
                            </div>

                            <!-- Prix -->
                            <div class="flex items-center gap-4">
                                <div class="text-right">
                                    @if($plan->is_free)
                                        <div class="text-xl font-normal text-gray-900 dark:text-white">
                                            0 € / 0 Ar
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Gratuit dans 30 jours</div>
                                    @else
                                        @if($isYearly)
                                            <div class="text-xl font-normal text-gray-900 dark:text-white">
                                                {{ number_format($plan->price_yearly / 12, 2, ',', ' ') }} € / {{ number_format($plan->price_local / 12, 0, ',', ' ') }} Ar
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">par mois</div>
                                        @else
                                            <div class="text-xl font-normal text-gray-900 dark:text-white">
                                                {{ number_format($plan->price_monthly, 2, ',', ' ') }} € / {{ number_format($plan->price_local, 0, ',', ' ') }} Ar
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">par mois</div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Fonctionnalités -->
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach(is_array($plan->features) ? $plan->features : json_decode($plan->features, true) as $feature)
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300 text-sm">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Bouton d'action -->
                            <div class="mt-6">
                                <button wire:click="selectPlan('{{ $plan->uuid }}')"
                                        wire:loading.attr="disabled"
                                        type="button"
                                        class="w-full text-center px-6 py-2.5 rounded-lg text-sm transition-all
                                            {{ $plan->is_free
                                                ? 'bg-green-600 text-white hover:bg-green-700'
                                                : ($plan->name === 'Solo Standard'
                                                    ? 'bg-primary-600 text-white hover:bg-primary-700'
                                                    : 'bg-indigo-600 text-white hover:bg-indigo-700') }}">
                                    <span wire:loading.remove wire:target="selectPlan">
                                        {{ $plan->is_free
                                            ? "Commencer gratuitement"
                                            : ($plan->name === 'Solo Standard'
                                                ? "Choisir l'offre recommandée"
                                                : 'Sélectionner ce plan') }}
                                    </span>
                                    <span wire:loading wire:target="selectPlan">
                                        Chargement...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
