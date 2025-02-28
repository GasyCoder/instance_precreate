<div class="lg:tw-col-span-4">
    <div class="tw-bg-white tw-rounded-2xl tw-shadow-sm hover:tw-shadow-lg tw-transition-shadow tw-duration-300">
        <div class="tw-p-6">
            <!-- Contenu existant avec quelques ajustements -->
            <div class="tw-space-y-6">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <h5 class="tw-text-lg tw-font-semibold tw-text-gray-900">Plans premium</h5>
                    @if($currentPlan)
                        <span class="tw-bg-indigo-50 tw-text-indigo-600 tw-px-3 tw-py-1.5 tw-rounded-full tw-text-sm">
                            Plan actuel : {{ $currentPlan->name }}
                        </span>
                    @endif
                </div>
                <p class="tw-text-gray-500 tw-text-sm tw-mt-3">
                    Boostez votre productivité avec nos solutions professionnelles
                </p>

                <!-- Toggle Switch -->
                <div class="tw-inline-flex tw-bg-gray-100 tw-rounded-full tw-p-1">
                    <input type="radio" id="monthly" name="pricing-period" class="tw-hidden peer/monthly">
                    <label for="monthly" class="tw-px-3 tw-py-1 tw-text-sm tw-rounded-full tw-cursor-pointer peer-checked/monthly:tw-bg-indigo-600 peer-checked/monthly:tw-text-white tw-transition-colors">
                        Mensuel
                    </label>

                    <input type="radio" id="yearly" name="pricing-period" class="tw-hidden peer/yearly" checked>
                    <label for="yearly" class="tw-px-3 tw-py-1 tw-text-sm tw-rounded-full tw-cursor-pointer peer-checked/yearly:tw-bg-indigo-600 peer-checked/yearly:tw-text-white tw-transition-colors tw-flex tw-items-center tw-gap-2">
                        Annuel 
                        <span class="tw-bg-green-500 tw-text-white tw-text-xs tw-px-2 tw-py-0.5 tw-rounded-full">-10%</span>
                    </label>
                </div>
            </div>

            <!-- Accordion des plans -->
            <div class="tw-space-y-3" x-data="{ openPlan: 2 }">
                @foreach($plans->where('is_free', false) as $index => $plan)
                    <div class="tw-mb-3">
                        <button @click="openPlan = {{ $plan->id }}" 
                                class="tw-w-full tw-text-left tw-p-4 tw-rounded-xl tw-transition-all
                                {{ $plan->name === 'Solo+' ? 'tw-bg-indigo-600 tw-text-white' : 'tw-bg-gray-50 hover:tw-bg-gray-100' }}">
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <div>
                                    <div class="tw-flex tw-items-center tw-gap-2">
                                        <h6 class="tw-m-0 tw-font-semibold {{ $plan->name === 'Solo+' ? 'tw-text-white' : 'tw-text-gray-900' }}">
                                            {{ $plan->name }}
                                        </h6>
                                        @if($plan->name === 'Solo+')
                                            <span class="tw-bg-white tw-text-indigo-600 tw-px-2 tw-py-1 tw-rounded-full tw-text-xs">
                                                Le plus choisi
                                            </span>
                                        @endif
                                    </div>
                                    <div class="tw-text-sm {{ $plan->name === 'Solo+' ? 'tw-text-indigo-100' : 'tw-text-gray-500' }} tw-mt-1">
                                        {{ $plan->name === 'Solo' ? 'Pour les freelances' :
                                           ($plan->name === 'Solo+' ? 'Pour les PME' : 'Pour les entreprises') }}
                                    </div>
                                </div>
                                <div class="tw-text-right">
                                    <div class="yearly-price">
                                        <span class="tw-font-semibold tw-text-lg {{ $plan->name === 'Solo+' ? 'tw-text-white' : 'tw-text-gray-900' }}">
                                            {{ number_format($plan->price_yearly / 12, 0, ',', ' ') }}
                                        </span>
                                        <span class="{{ $plan->name === 'Solo+' ? 'tw-text-indigo-100' : 'tw-text-gray-500' }}">
                                            Ar/mois
                                        </span>
                                    </div>
                                    <div class="monthly-price tw-hidden">
                                        <span class="tw-font-semibold tw-text-lg {{ $plan->name === 'Solo+' ? 'tw-text-white' : 'tw-text-gray-900' }}">
                                            {{ number_format($plan->price_monthly, 0, ',', ' ') }}
                                        </span>
                                        <span class="{{ $plan->name === 'Solo+' ? 'tw-text-indigo-100' : 'tw-text-gray-500' }}">
                                            Ar/mois
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </button>

                        <div x-show="openPlan === {{ $plan->id }}"
                             x-transition:enter="tw-transition tw-ease-out tw-duration-200"
                             x-transition:enter-start="tw-opacity-0 tw-transform tw-scale-95"
                             x-transition:enter-end="tw-opacity-100 tw-transform tw-scale-100"
                             class="tw-p-4">
                            <!-- Prix annuel -->
                            <div class="tw-bg-green-50 tw-rounded-xl tw-p-4 tw-mb-4">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <div>
                                        <div class="tw-text-green-600 tw-font-medium tw-mb-1">Prix annuel réduit</div>
                                        <div class="tw-text-green-600">
                                            <strong class="tw-text-xl">
                                                {{ number_format($plan->price_yearly, 0, ',', ' ') }}
                                            </strong>
                                            <small>Ar/an</small>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="tw-bg-green-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-full tw-text-sm">
                                            Économisez {{ number_format($plan->price_monthly * 12 - $plan->price_yearly, 0, ',', ' ') }} Ar
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Fonctionnalités -->
                            <div class="tw-mb-6">
                                <h6 class="tw-font-medium tw-mb-3">Fonctionnalités incluses :</h6>
                                @foreach($plan->features as $feature)
                                    <div class="tw-flex tw-items-center tw-gap-2 tw-mb-2">
                                        <svg class="tw-w-5 tw-h-5 tw-text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="tw-text-gray-600">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button"
                                    wire:click="changePlan('{{ $plan->uuid }}')"
                                    class="tw-w-full tw-rounded-lg tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-transition-colors
                                    {{ $plan->name === 'Solo+' ? 
                                        'tw-bg-indigo-600 tw-text-white hover:tw-bg-indigo-700' : 
                                        'tw-border tw-border-indigo-600 tw-text-indigo-600 hover:tw-bg-indigo-50' }}">
                                <span class="tw-flex tw-items-center tw-justify-center tw-gap-2">
                                    <span>{{ $plan->name === 'Solo+' ? 'Choisir l\'offre recommandée' : 'Sélectionner ce plan' }}</span>
                                    <svg class="tw-w-4 tw-h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthlyRadio = document.getElementById('monthly');
    const yearlyRadio = document.getElementById('yearly');
    const monthlyPrices = document.querySelectorAll('.monthly-price');
    const yearlyPrices = document.querySelectorAll('.yearly-price');

    function togglePrices() {
        const isMonthly = monthlyRadio.checked;
        monthlyPrices.forEach(el => el.classList.toggle('tw-hidden', !isMonthly));
        yearlyPrices.forEach(el => el.classList.toggle('tw-hidden', isMonthly));
    }

    monthlyRadio.addEventListener('change', togglePrices);
    yearlyRadio.addEventListener('change', togglePrices);
});
</script>
@endpush