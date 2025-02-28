<div class="bg-white/80 dark:bg-dark-bg backdrop-blur-xl rounded-2xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 overflow-hidden">
    <!-- Header Section -->
    <div class="p-6 space-y-4">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <!-- Title and Counters -->
            <div class="flex-1">
                <div class="flex items-baseline gap-3">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Mes instances
                    </h2>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300">
                            Total: {{ $instances->count() }}
                        </span>
                        <span class="inline-flex items-center text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300">
                            Actives: {{ $instances->where('status', 'active')->count() }}
                        </span>
                    </div>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Gérez vos espaces de travail et suivez leur état en temps réel
                </p>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input type="search"
                           wire:model.debounce.300ms="search"
                           placeholder="Rechercher une instance..."
                           class="w-full px-4 py-2 pl-10 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-600 focus:border-transparent">
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <a href="#plan"
                   class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium transition duration-150 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>Nouvelle instance</span>
                </a>
            </div>
        </div>

        @if($instances->isNotEmpty())
            <!-- Table Section -->
            <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Instance
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Plan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Validité
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($instances as $instance)
                                <tr class="group hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-150">
                                    <!-- Instance Info -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <!-- Logo/Flag -->
                                            <div class="relative flex-shrink-0">
                                                <div class="h-8 w-8 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden shadow-sm">
                                                    <img src="{{ asset('client/assets/img/flags/' . ($instance->pays === 0 ? '0.png' : '1.png')) }}"
                                                         alt="Flag"
                                                         class="h-6 w-6 object-cover">
                                                </div>
                                                @if($instance->status === 'active')
                                                    <span class="absolute -bottom-1 -right-1 flex h-4 w-4">
                                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-50"></span>
                                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500 border-2 border-white dark:border-gray-800"></span>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Instance Details -->
                                            <div class="flex flex-col min-w-0">
                                                <span class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $instance->name }}
                                                </span>
                                                <a href="{{ $instance->url }}"
                                                   target="_blank"
                                                   class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 truncate">
                                                    {{ $instance->url }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Plan -->
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300">
                                            {{ $instance->plan?->name ?? $instance->subscription?->plan?->name ?? 'Free' }}
                                            @if($instance->subPlan)
                                                ({{ $instance->subPlan->name }})
                                            @elseif($instance->plan?->has_sub_plans)
                                                (Basic)
                                            @endif
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $instance->isTrialPeriod ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300' : 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' }}">
                                            {{ $instance->isTrialPeriod ? 'Essai' : 'Payé' }}
                                        </span>
                                    </td>

                                    <!-- Validité -->
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            @if($instance->isTrialPeriod)
                                                {{ $instance->remainingTrialDays > 0 ? (int)$instance->remainingTrialDays . 'j restants' : '-' }}
                                            @else
                                                {{ $instance->isAnnual ? '12mois' : '30j' }}
                                            @endif
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if($instance->isTrialPeriod)
                                                <button
                                                    wire:click="upgradeInstance({{ $instance->id }})"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors"
                                                    title="Passez à une version payante">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                                    </svg>
                                                    <span class="hidden sm:inline">Mettre à niveau</span>
                                                </button>
                                            @elseif($instance->canChangePlan)
                                                <button
                                                    wire:click="updateInstance({{ $instance->id }})"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors"
                                                    title="Changer le plan actuel">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    <span class="hidden sm:inline">Changer d’offre</span>
                                                </button>
                                            @else
                                                <button disabled
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed"
                                                        title="Changement d'offre possible dans {{ $instance->daysUntilChange }} jours">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    <span class="hidden sm:inline">Changer d’offre</span>
                                                </button>
                                            @endif

                                            <!-- Access Button -->
                                            <a href="{{ $instance->url }}"
                                               target="_blank"
                                               class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                                <span class="hidden sm:inline">Accéder</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    {{ $instances->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="rounded-xl border border-dashed border-gray-200 dark:border-gray-700">
                <div class="flex flex-col items-center justify-center px-6 py-16 text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/50">
                        <svg class="h-10 w-10 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">
                        Aucune instance
                    </h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Vous n'avez pas encore créé d'instance. Commencez par en créer une nouvelle.
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Instance Details Modal -->
    @if($instanceId)
        <div class="fixed inset-0 z-50 overflow-y-auto"
            x-data="{ open: @entangle('instanceId') }"
            x-show="open"
            x-cloak>
            <div class="flex min-h-screen items-center justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/75 transition-opacity"
                    x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                </div>

                <!-- Modal Panel -->
                <div class="transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                    x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                    <!-- Modal Content -->
                    <div class="px-6 py-6">
                        <div class="flex items-start justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Détails de l'instance
                            </h3>
                            <button wire:click="closeModal"
                                    class="ml-4 text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-6">
                            <!-- Instance Info -->
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                                <div class="flex items-center gap-4">
                                    <div class="h-16 w-16 rounded-xl bg-white dark:bg-gray-800 flex items-center justify-center">
                                        <img src="{{ asset('client/assets/img/flags/' . ($instance->pays === 0 ? '0.png' : '1.png')) }}"
                                            alt="Flag"
                                            class="h-10 w-10 object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">
                                            {{ $name }}
                                        </h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $reference }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Details Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Created Date -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Créé le
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $created_at }}
                                    </p>
                                </div>

                                <!-- Expiration Date -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Expire le
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $expiration_date }}
                                    </p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Statut
                                    </label>
                                    <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                        {{ $status }}
                                    </span>
                                </div>

                                <!-- Plan Type -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                        Type de plan
                                    </label>
                                    <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300">
                                        {{ $planType }}
                                    </span>
                                </div>
                            </div>

                            <!-- URL -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">
                                    URL de l'instance
                                </label>
                                <a href="{{ $url }}"
                                target="_blank"
                                class="mt-1 inline-flex items-center text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                    {{ $url }}
                                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            </div>

                            <!-- Modules -->
                            @if(!empty($modules))
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                                    Modules activés
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($modules as $module)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                            {{ $module }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex justify-end gap-3">
                        <button wire:click="closeModal"
                                class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Fermer
                        </button>
                        <a href="{{ $url }}"
                        target="_blank"
                        class="inline-flex justify-center items-center px-4 py-2 rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Accéder à l'instance
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
