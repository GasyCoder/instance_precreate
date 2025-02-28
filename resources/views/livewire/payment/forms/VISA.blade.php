<form wire:submit.prevent="processPayment" class="space-y-6">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-light-text dark:text-dark-text mb-1">Nom du titulaire</label>
            <div class="relative">
                <input type="text"
                    wire:model.defer="cardInfo.name"
                    class="w-full rounded-xl border-light-border dark:border-dark-border/60 bg-light-bg dark:bg-dark-bg/30 text-light-text dark:text-dark-text placeholder-light-muted dark:placeholder-dark-muted pl-4 pr-10 focus:border-primary-500 focus:ring-primary-500 dark:focus:ring-primary-400"
                    placeholder="Ex: John Doe">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="h-5 w-5 text-light-muted dark:text-dark-muted" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 14H5c-.55 0-1-.45-1-1V7c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v10c0 .55-.45 1-1 1z"/>
                    </svg>
                </div>
            </div>
            @error('cardInfo.name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-light-text dark:text-dark-text mb-1">Numéro de carte</label>
            <div class="relative">
                <input type="text"
                    wire:model.defer="cardInfo.number"
                    class="w-full rounded-xl border-light-border dark:border-dark-border/60 bg-light-bg dark:bg-dark-bg/30 text-light-text dark:text-dark-text placeholder-light-muted dark:placeholder-dark-muted pl-4 pr-10 focus:border-primary-500 focus:ring-primary-500 dark:focus:ring-primary-400"
                    placeholder="4242 4242 4242 4242">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="h-5 w-5 text-light-muted dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
            @error('cardInfo.number') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-light-text dark:text-dark-text mb-1">Date d'expiration</label>
                <input type="text"
                    wire:model.defer="cardInfo.expiry"
                    class="w-full rounded-xl border-light-border dark:border-dark-border/60 bg-light-bg dark:bg-dark-bg/30 text-light-text dark:text-dark-text placeholder-light-muted dark:placeholder-dark-muted focus:border-primary-500 focus:ring-primary-500 dark:focus:ring-primary-400"
                    placeholder="MM/YY">
                @error('cardInfo.expiry') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-light-text dark:text-dark-text mb-1">Code CVC</label>
                <input type="text"
                    wire:model.defer="cardInfo.cvc"
                    class="w-full rounded-xl border-light-border dark:border-dark-border/60 bg-light-bg dark:bg-dark-bg/30 text-light-text dark:text-dark-text placeholder-light-muted dark:placeholder-dark-muted focus:border-primary-500 focus:ring-primary-500 dark:focus:ring-primary-400"
                    placeholder="123">
                @error('cardInfo.cvc') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="w-full bg-green-600 dark:bg-green-700 text-white py-3 rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition-colors">
        Payer {{ number_format($primaryPrice, $primaryCurrency === 'MGA' ? 0 : 2) }} {{ $primaryCurrency }}
    </button>
</form>
