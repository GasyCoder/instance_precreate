<div class="lg:tw-col-span-8">
    <div class="tw-bg-white tw-rounded-2xl tw-shadow-sm hover:tw-shadow-lg tw-transition-shadow tw-duration-300">
        <div class="tw-p-6">
            <!-- En-tête -->
            <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
                <h5 class="tw-font-medium tw-m-0">Mes espaces de travail</h5>
                <button class="tw-bg-indigo-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-lg tw-inline-flex tw-items-center tw-gap-2 hover:tw-bg-indigo-700 tw-transition-colors"
                        data-bs-toggle="modal"
                        data-bs-target="#instanceModal">
                    <svg class="tw-w-4 tw-h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Créer mon espace</span>
                </button>
            </div>

            @if($instances->isNotEmpty())
                <div class="tw-overflow-x-auto">
                    <table class="tw-w-full tw-min-w-full">
                        <thead>
                            <tr>
                                <th class="tw-py-3 tw-text-gray-500 tw-text-xs tw-uppercase tw-font-medium tw-text-left">Instance</th>
                                <th class="tw-py-3 tw-text-gray-500 tw-text-xs tw-uppercase tw-font-medium tw-text-left">Identifiant</th>
                                <th class="tw-py-3 tw-text-gray-500 tw-text-xs tw-uppercase tw-font-medium tw-text-left">Créé le</th>
                                <th class="tw-py-3 tw-text-gray-500 tw-text-xs tw-uppercase tw-font-medium tw-text-left">Expiré</th>
                                <th class="tw-py-3 tw-text-gray-500 tw-text-xs tw-uppercase tw-font-medium tw-text-left">Statut</th>
                                <th class="tw-py-3 tw-text-gray-500 tw-text-xs tw-uppercase tw-font-medium tw-text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instances as $instance)
                                <tr class="tw-border-b">
                                    <td class="tw-py-3">
                                        <div class="tw-flex tw-items-center tw-gap-2">
                                            <img src="{{ asset('assets/img/flags/' . ($instance->pays === 0 ? '0.png' : '1.png')) }}"
                                                 alt="{{ $instance->getPaysNomAttribute() }}"
                                                 class="tw-w-5 tw-h-5 tw-rounded">
                                            <span class="tw-font-medium">{{ $instance->getPaysNomAttribute() }}</span>
                                        </div>
                                    </td>
                                    <td class="tw-py-3">{{ $instance->dolibarr_username }}</td>
                                    <td class="tw-py-3 tw-text-gray-500">{{ Carbon\Carbon::parse($instance->created_at)->format('d/m/Y') }}</td>
                                    <td class="tw-py-3 tw-text-gray-500">{{ $this->getFormattedEndDate() }}</td>
                                    <td class="tw-py-3">
                                        <span class="tw-bg-green-50 tw-text-green-600 tw-px-2 tw-py-1 tw-rounded-full tw-text-sm">
                                            Active
                                        </span>
                                    </td>
                                    <td class="tw-py-3 tw-text-right">
                                        <div class="tw-relative" x-data="{ open: false }">
                                            <button @click="open = !open"
                                                    class="tw-p-2 tw-rounded-full hover:tw-bg-gray-100 tw-transition-colors">
                                                <svg class="tw-w-5 tw-h-5 tw-text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                                </svg>
                                            </button>
                                            <div x-show="open"
                                                 @click.away="open = false"
                                                 class="tw-absolute tw-right-0 tw-mt-2 tw-w-48 tw-rounded-lg tw-shadow-lg tw-bg-white tw-ring-1 tw-ring-black tw-ring-opacity-5">
                                                <a href="{{ $instance->url }}"
                                                   target="_blank"
                                                   class="tw-flex tw-items-center tw-gap-2 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50">
                                                    <svg class="tw-w-4 tw-h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                    </svg>
                                                    <span>Accéder</span>
                                                </a>
                                                <button wire:click="viewDetail({{ $instance->id }})"
                                                        class="tw-flex tw-items-center tw-gap-2 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 tw-w-full tw-text-left"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailModal">
                                                    <svg class="tw-w-4 tw-h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    <span>Détails</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="tw-text-center tw-py-10">
                    <!-- Icône -->
                    <div class="tw-inline-flex tw-p-3 tw-rounded-full tw-bg-gray-50 tw-mb-4">
                        <svg class="tw-w-8 tw-h-8 tw-text-yellow-500 tw-opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </div>
                    <h5 class="tw-font-medium tw-mb-3">Aucun espace de travail</h5>
                    <p class="tw-text-gray-500 tw-mb-6">
                        Créez votre premier espace de travail pour commencer.
                    </p>

                    <!-- Avantages -->
                    <div class="tw-flex tw-items-center tw-justify-center tw-gap-3 tw-flex-wrap tw-mb-6">
                        <span class="tw-bg-gray-50 tw-text-gray-600 tw-px-3 tw-py-1.5 tw-rounded-full tw-flex tw-items-center tw-gap-1 tw-text-sm">
                            <svg class="tw-w-4 tw-h-4 tw-text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            30 jours gratuits
                        </span>
                        <span class="tw-bg-gray-50 tw-text-gray-600 tw-px-3 tw-py-1.5 tw-rounded-full tw-flex tw-items-center tw-gap-1 tw-text-sm">
                            <svg class="tw-w-4 tw-h-4 tw-text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                            </svg>
                            1 instance offerte
                        </span>
                        <span class="tw-bg-gray-50 tw-text-gray-600 tw-px-3 tw-py-1.5 tw-rounded-full tw-flex tw-items-center tw-gap-1 tw-text-sm">
                            <svg class="tw-w-4 tw-h-4 tw-text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Sans engagement
                        </span>
                    </div>

                    <!-- Message de confiance -->
                    <p class="tw-text-gray-500 tw-text-sm tw-mb-0">
                        <svg class="tw-w-4 tw-h-4 tw-text-indigo-500 tw-inline tw-mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        1000+ entreprises nous font confiance
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>