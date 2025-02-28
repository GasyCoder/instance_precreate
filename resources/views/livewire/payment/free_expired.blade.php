{{-- livewire.payment.free_expired --}}
<div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 mb-4">
    <svg class="h-6 w-6 text-red-600 dark:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
    </svg>
</div>
<h3 class="text-lg font-medium text-gray-900 dark:text-white">Limite d'instances atteinte</h3>
<p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
    Passez à un forfait supérieur pour créer plus d'instances
</p>
<div class="mt-6">
    <button class="btn-primary py-2 px-4 rounded-lg text-sm font-semibold"
            data-bs-toggle="modal"
            data-bs-target="#pricingModal">
        <span class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span>Voir les forfaits</span>
        </span>
    </button>
</div>
