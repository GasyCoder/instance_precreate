<div x-data="{
    show: !localStorage.getItem('flashMessageExpired'),
    timer: 10,
    startTimer() {
        if (localStorage.getItem('flashMessageExpired')) {
            this.show = false;
            return;
        }

        this.timer = 10;
        const countdown = setInterval(() => {
            this.timer--;
            if (this.timer <= 0) {
                clearInterval(countdown);
                this.show = false;
                // Marquer le message comme expiré dans le localStorage
                localStorage.setItem('flashMessageExpired', 'true');
            }
        }, 1000);
    }
}"
    x-init="startTimer()"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    class="mb-6 relative">

    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/50 rounded-lg p-4">
        <div class="flex">
            {{-- Icône et contenu --}}
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>

            <div class="ml-3 flex-1">
                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">
                    {{ $infoMessage['title'] }}
                </h3>
                <p class="mt-1 text-sm text-blue-700 dark:text-blue-400">
                    {{ $infoMessage['content'] }}
                </p>
            </div>

            {{-- Timer et bouton fermer --}}
            <div class="flex-shrink-0 flex items-start gap-2">
                <span class="text-sm text-blue-600 dark:text-blue-400" x-text="`${timer}s`"></span>
                <button @click="show = false; localStorage.setItem('flashMessageExpired', 'true')"
                        class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Barre de progression --}}
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-100 dark:bg-blue-800/30 rounded-b-lg overflow-hidden">
            <div class="h-full bg-blue-500 dark:bg-blue-400/50 transition-all duration-1000 ease-linear"
                 x-bind:style="`width: ${(timer / 10) * 100}%`">
            </div>
        </div>
    </div>
</div>

{{-- Script pour réinitialiser le localStorage lors d'un nouveau message --}}
<script>
    // Réinitialiser le localStorage lorsqu'un nouveau message est affiché
    document.addEventListener('DOMContentLoaded', () => {
        // Générer un ID unique pour le message actuel (basé sur le titre et le contenu)
        const currentMessageId = btoa('{{ $infoMessage['title'] }}' + '{{ $infoMessage['content'] }}');
        const storedMessageId = localStorage.getItem('flashMessageId');

        // Si c'est un nouveau message, réinitialiser l'état
        if (currentMessageId !== storedMessageId) {
            localStorage.removeItem('flashMessageExpired');
            localStorage.setItem('flashMessageId', currentMessageId);
        }
    });
</script>
