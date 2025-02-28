<!-- Header avec navigation -->
<div class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 py-4  mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('espaceClient') }}" wire:navigate class="flex items-center text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="ml-2 text-sm font-medium">Retour au précedent</span>
                </a>
                {{-- <span class="text-gray-300 dark:text-gray-600">/</span>
                <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $title ?? 'Page titre' }}</span> --}}
            </div>
        </div>
    </div>
</div>
