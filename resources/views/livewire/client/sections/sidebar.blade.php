{{-- resources/views/livewire/client/sections/sidebar.blade.php --}}
<div class="space-y-5">
    <!-- Guide de création -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-5">
        <h4 class="text-base font-medium text-gray-900 dark:text-white mb-4">Guide de création</h4>
        <div class="space-y-4">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-primary-50 dark:bg-primary-900/50 flex items-center justify-center">
                    <span class="text-primary-600 dark:text-primary-400 text-sm font-medium">1</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Choisissez un nom unique pour votre instance</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-primary-50 dark:bg-primary-900/50 flex items-center justify-center">
                    <span class="text-primary-600 dark:text-primary-400 text-sm font-medium">2</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Sélectionnez votre entreprise dans la liste</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-primary-50 dark:bg-primary-900/50 flex items-center justify-center">
                    <span class="text-primary-600 dark:text-primary-400 text-sm font-medium">3</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Confirmez la création de votre instance</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Informations utiles -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-5">
        <h4 class="text-base font-medium text-gray-900 dark:text-white mb-4">Informations utiles</h4>
        <div class="space-y-4">
            <div class="flex items-start gap-3">
                <svg class="h-5 w-5 text-primary-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    Le nom de votre instance doit être unique et ne peut pas être modifié ultérieurement
                </p>
            </div>
            <div class="flex items-start gap-3">
                <svg class="h-5 w-5 text-primary-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    La création de votre instance peut prendre quelques minutes
                </p>
            </div>
        </div>
    </div>

    <!-- Support -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/50 dark:border-gray-700/50 p-5">
        <h4 class="text-base font-medium text-gray-900 dark:text-white mb-4">Besoin d'aide ?</h4>
        <div class="space-y-3">
            <a href="#" class="flex items-center gap-2 text-primary-600 dark:text-primary-400 text-sm hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Consulter la FAQ</span>
            </a>
            <a href="#" class="flex items-center gap-2 text-primary-600 dark:text-primary-400 text-sm hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Contacter le support</span>
            </a>
        </div>
    </div>
</div>
