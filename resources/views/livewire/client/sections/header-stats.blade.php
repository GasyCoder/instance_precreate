<!-- header-stats.blade.php -->
<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
        <div>
            <h1 class="text-2xl font-normal text-gray-900 dark:text-white">Mon espace de travail</h1>
            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Gérez vos instances et abonnements</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Instances actives -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 hover:shadow-sm transition-all duration-200">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Instances actives</p>
                    <p class="mt-1 text-2xl font-normal text-gray-900 dark:text-white">
                        {{ $instances->count() }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Plan actuel -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 hover:shadow-sm transition-all duration-200">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
                    <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Plan actuel</p>
                    <div class="mt-1">
                        <p class="text-2xl font-normal text-gray-900 dark:text-white">
                            {{ $currentPlan ? $currentPlan->name : 'Gratuit' }}
                        </p>
                        @if($user->subscriptions()->where('status', 'trial')->exists())
                            <span class="text-sm text-red-600 dark:text-red-400">Période d'essai</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Expiration -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 hover:shadow-sm transition-all duration-200">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-xl">
                    <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Expiration</p>
                    <p class="mt-1 text-2xl font-normal text-gray-900 dark:text-white">
                        {{ $this->getFormattedEndDate() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
