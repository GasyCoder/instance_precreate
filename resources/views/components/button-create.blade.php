<button type="submit"
        wire:loading.attr="disabled"
        class="inline-flex items-center gap-2 px-3 py-2 bg-primary-600 hover:bg-primary-700 rounded-lg text-sm font-medium text-white shadow-sm shadow-primary-600/20 hover:shadow-primary-600/30 transform hover:-translate-y-0.5 transition-all duration-200">
    <!-- Texte normal et loading -->
    <span wire:loading.remove>Créer l'instance</span>
    <span wire:loading>Un instant...</span>

    <!-- Icône (visible quand pas de loading) -->
    <svg wire:loading.remove class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
    </svg>

    <!-- Spinner (visible pendant le loading) -->
    <svg wire:loading class="animate-spin w-3.5 h-3.5" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
    </svg>
</button>
