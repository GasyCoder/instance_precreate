{{-- Modal principal avec préfixe tw- --}}
<div
    x-data="{
        open: false,
        showPassword: false,
        copyFeedback: {
            password: false,
            url: false
        },
        async copyToClipboard(text, type) {
            try {
                await navigator.clipboard.writeText(text);
                this.copyFeedback[type] = true;
                setTimeout(() => {
                    this.copyFeedback[type] = false;
                }, 1500);
            } catch (err) {
                console.error('Erreur de copie:', err);
            }
        }
    }"
    wire:ignore.self
    class="tw-fixed tw-inset-0 tw-overflow-y-auto tw-z-50"
    id="instanceModal"
>
    {{-- Conteneur principal --}}
    <div class="tw-min-h-screen tw-px-4 tw-flex tw-items-center tw-justify-center">
        {{-- Backdrop avec flou --}}
        <div class="tw-fixed tw-inset-0 tw-bg-gray-500/75 tw-backdrop-blur-sm tw-transition-opacity"></div>

        {{-- Contenu du modal --}}
        <div class="tw-relative tw-w-full tw-max-w-2xl tw-bg-white tw-rounded-2xl tw-shadow-xl tw-transform tw-transition-all">
            {{-- Bouton de fermeture --}}
            <button
                type="button"
                data-bs-dismiss="modal"
                onclick="location.reload();"
                class="tw-absolute tw-right-4 tw-top-4 tw-p-2 tw-rounded-full tw-text-gray-400 hover:tw-text-gray-500 hover:tw-bg-gray-100 tw-transition-all tw-duration-200"
            >
                <span class="tw-sr-only">Fermer</span>
                <svg class="tw-h-6 tw-w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Contenu dynamique --}}
            <div class="tw-p-8">
                @if($newInstanceInfo)
                    @include('livewire.client.success-info')
                @else
                    @include('livewire.client.create-isntances')
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Overlay de chargement --}}
<div
    wire:loading.flex
    wire:target="store"
    class="tw-fixed tw-inset-0 tw-bg-white/90 tw-flex tw-items-center tw-justify-center tw-z-50"
>
    <div class="tw-text-center">
        <div class="tw-flex tw-justify-center tw-space-x-2">
            @for($i = 0; $i < 5; $i++)
                <div
                    class="tw-w-3 tw-h-8 tw-bg-primary-600 tw-animate-wave"
                    style="animation-delay: {{ $i * 0.15 }}s"
                >
                </div>
            @endfor
        </div>
        <h3 class="tw-mt-4 tw-text-lg tw-font-medium tw-text-gray-900">
            Création de l'instance en cours...
        </h3>
        <p class="tw-mt-2 tw-text-sm tw-text-gray-500">
            Veuillez patienter quelques instants
        </p>
    </div>
</div>

@push('styles')
<style>
@keyframes wave {
    0%, 40%, 100% { transform: scaleY(0.4); }
    20% { transform: scaleY(1); }
}
.tw-animate-wave {
    animation: wave 1.2s infinite ease-in-out;
}
</style>
@endpush
