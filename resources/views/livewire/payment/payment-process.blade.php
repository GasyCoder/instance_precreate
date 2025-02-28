{{-- payment-process.blade.php --}}
<div class="min-h-screen pt-16">
    <!-- En-tête avec progression -->
    <div class="bg-light-bg dark:bg-dark-bg shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('espaceClient') }}"
                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour à l'espace client
                    </a>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                        Finaliser votre abonnement
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Colonne gauche : Options de paiement -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Carte d'essai gratuit -->
                    @include('livewire.payment.version-trial')
                    <div
                    x-data="{ open: false }"
                    x-show="open"
                    x-on:open-payment-modal.window="open = true"
                    x-on:close-payment-modal.window="open = false"
                    x-on:keydown.escape.window="open = false"
                    style="display: none;" class="bg-light-bg dark:bg-dark-bg/20 rounded-2xl shadow-sm border border-light-border dark:border-dark-border/80">
                        <div class="p-6">
                            <div class="justify-between mb-6">
                                <h3 class="text-sm font-bold text-light-text dark:text-dark-text">
                                    @if($upgradeType === 'upgrade')
                                        Mise à niveau de l'instance
                                        <span class="text-primary-600 dark:text-primary-400">{{ $currentInstance->name }}.erpinnov.com</span>
                                    @else
                                        Création d'une nouvelle instance
                                    @endif
                                </h3>
                                <p class="mt-1 text-light-muted dark:text-dark-muted">
                                    @if($upgradeType === 'upgrade')
                                        Vous allez mettre à niveau votre instance existante
                                    @else
                                        Vous allez créer une nouvelle instance payante
                                    @endif
                                </p>
                            </div>
                            <!-- Options de paiement -->
                            <div class="grid grid-cols-3 gap-4 mb-8">
                                @foreach([
                                    ['id' => 'VISA', 'name' => 'Carte bancaire', 'logo' => 'visa.svg'],
                                    ['id' => 'OrangeMoney', 'name' => 'Orange Money', 'logo' => 'OM.svg'],
                                    ['id' => 'Mvola', 'name' => 'MVola', 'logo' => 'MVOLA.png']
                                ] as $method)
                                    <label class="relative block cursor-pointer">
                                        <input type="radio"
                                            name="payment_method"
                                            value="{{ $method['id'] }}"
                                            wire:model="paymentMethod"
                                            class="sr-only peer">
                                        <div class="p-4 rounded-xl border-2 transition-all duration-200
                                            {{ $paymentMethod === $method['id']
                                                ? 'border-primary-500 bg-primary-50/50 dark:border-primary-400 dark:bg-primary-900/10'
                                                : 'border-light-border dark:border-dark-border/60 hover:border-primary-200 dark:hover:border-primary-700/70' }}
                                                bg-light-bg dark:bg-dark-bg/30">
                                            <div class="flex flex-col items-center">
                                                <img src="{{ asset('client/assets/img/logo/' . $method['logo']) }}"
                                                    alt="{{ $method['name'] }}"
                                                    class="h-12 w-auto mb-0 transition-transform duration-200 transform peer-hover:scale-105">
                                                <span class="text-sm font-medium text-light-text dark:text-dark-text">{{ $method['name'] }}</span>
                                                @if($method['id'] === 'VISA')
                                                    <small class="text-sm text-green-600 dark:text-green-400">Récommandé</small>
                                                @endif
                                                @if($method['id'] === 'OrangeMoney')
                                                    <span class="text-sm text-light-muted dark:text-dark-muted">+261 32 74 555 00</span>
                                                @endif
                                                @if($method['id'] === 'Mvola')
                                                    <span class="text-sm text-light-muted dark:text-dark-muted">+261 34 74 555 00</span>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <!-- Formulaires de paiement -->
                            @if($paymentMethod)
                                <div class="mt-8 border-t border-light-border dark:border-dark-border/60 pt-8">
                                <!-- Formulaires de paiement détaillés -->
                                    @if($paymentMethod === 'VISA')
                                    @include('livewire.payment.forms.VISA')
                                    {{-- @else
                                    @include('livewire.payment.forms.MobileMoney') --}}
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Colonne droite : Résumé -->
                <div class="lg:col-span-4">
                    <div class="sticky top-24 rounded-2xl shadow-sm border border-light-border dark:border-dark-border/80 bg-light-bg dark:bg-dark-bg/20">
                        <!-- En-tête du résumé -->
                        <div class="p-6 border-b border-light-border dark:border-dark-border/60">
                            <h3 class="text-lg font-semibold text-light-text dark:text-dark-text">Résumé de votre commande</h3>
                        </div>

                        <!-- Contenu du résumé -->
                        <div class="p-6 space-y-6">
                            <!-- Détails du plan -->
                            <div class="space-y-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="px-3 py-1 rounded-full bg-green-400 text-gray-50 dark:bg-primary-900/30 dark:text-gray-50 text-sm font-medium">
                                            {{ $plan->name }}
                                            @if($selectedSubPlan)
                                                - {{ $selectedSubPlan->name }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-xl font-bold text-light-text dark:text-dark-text" wire:key="price-{{ $isAnnual }}">
                                            {{ number_format($primaryPrice, $primaryCurrency === 'MGA' ? 0 : 2) }} {{ $primaryCurrency }}
                                        </div>
                                        <div class="text-sm text-light-muted dark:text-dark-muted">
                                            {{ number_format($secondaryPrice, $secondaryCurrency === 'MGA' ? 0 : 2) }} {{ $secondaryCurrency }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Sélection période -->
                                <div class="bg-gray-50 dark:bg-dark-bg/40 rounded-xl p-4">
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center space-x-3 cursor-pointer">
                                            <div class="relative">
                                                <input type="checkbox"
                                                    wire:model.live="isAnnual"
                                                    class="sr-only peer">
                                                <div class="w-11 h-6 bg-gray-200 dark:bg-gray-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-primary-600 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                            </div>
                                            <span class="text-sm font-medium text-light-text dark:text-dark-text">Facturation annuelle</span>
                                        </label>
                                    </div>

                                    @if($isAnnual)
                                    <div class="mt-2 flex items-center text-xs text-green-600 dark:text-green-400">
                                        <svg class="w-5 h-5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Économisez 10% sur l'abonnement annuel
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Garanties -->
                            <div class="space-y-4">
                                <!-- Sécurité -->
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-light-text dark:text-dark-text">Paiement sécurisé</h4>
                                        <p class="mt-1 text-sm text-light-muted dark:text-dark-muted">Vos données sont protégées et chiffrées</p>
                                    </div>
                                </div>

                                <!-- Support -->
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-light-text dark:text-dark-text">Support dédié</h4>
                                        <p class="mt-1 text-sm text-light-muted dark:text-dark-muted">Une équipe à votre écoute 24/7</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Conditions -->
                            <div class="pt-6 border-t border-light-border dark:border-dark-border/60">
                                <p class="text-sm text-light-muted dark:text-dark-muted">
                                    En procédant au paiement, vous acceptez nos
                                    <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 hover:underline">conditions générales</a>
                                    et notre
                                    <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 hover:underline">politique de confidentialité</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </main>

</div>

@push('styles')
<style>
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .payment-method-selected {
        animation: pulse 2s infinite;
    }

    .group:hover img {
        transform: scale(1.05);
        transition: transform 0.2s ease-in-out;
    }
</style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            // Définir les fractions de décimales en fonction de la devise principale
            const primaryDecimalPlaces = '{{ $primaryCurrency === 'MGA' ? 0 : 2 }}';
            const secondaryDecimalPlaces = '{{ $secondaryCurrency === 'MGA' ? 0 : 2 }}';

            Livewire.on('priceUpdated', (data) => {
                // Mettre à jour le prix dans la vue dynamiquement
                const primaryPriceElement = document.querySelector('.text-xl.font-bold.text-gray-900');
                const secondaryPriceElement = document.querySelector('.text-sm.text-gray-500');
                if (primaryPriceElement && secondaryPriceElement) {
                    primaryPriceElement.textContent = `${data.total.toLocaleString('fr-FR', {
                        minimumFractionDigits: parseInt(primaryDecimalPlaces),
                        maximumFractionDigits: parseInt(primaryDecimalPlaces)
                    })} {{ $primaryCurrency }}`;
                    secondaryPriceElement.textContent = `${data.total.toLocaleString('fr-FR', {
                        minimumFractionDigits: parseInt(secondaryDecimalPlaces),
                        maximumFractionDigits: parseInt(secondaryDecimalPlaces)
                    })} {{ $secondaryCurrency }}`;
                }
            });
        });
    </script>
@endpush
