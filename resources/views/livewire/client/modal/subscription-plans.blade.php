<div>
<!-- Pricing Modal -->
<div wire:ignore class="modal fade" id="pricingModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body p-3">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Header Section -->
                <div class="text-center mb-3">
                    <h4 class="fw-bold mb-2">{{ __('Plans premium')}}</h4>
                    <p class="text-muted small mb-2">
                        Tous les plans incluent des outils et fonctionnalités avancés.
                    </p>

                    <!-- Toggle Switch -->
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 mb-3">
                        <div class="btn-group pricing-toggle-group" role="group">
                            <input type="radio" class="btn-check" name="pricing-period" id="monthly" autocomplete="off">
                            <label class="btn btn-outline-primary btn-sm" for="monthly">Mensuel</label>

                            <input type="radio" class="btn-check" name="pricing-period" id="yearly" autocomplete="off" checked>
                            <label class="btn btn-outline-primary btn-sm" for="yearly">
                                Annuel <span class="badge bg-success ms-1">-10%</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Pricing Cards -->
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    @foreach($plans as $plan)
                    <div class="col">
                        <div class="card h-100 border {{ $plan->name === 'Solo+' ? 'border-primary shadow' : '' }} rounded-3">
                            <div class="card-body p-3">
                                @if($plan->name === 'Solo+')
                                <div class="position-absolute top-0 end-0 mt-2 me-2">
                                    <span class="badge bg-primary small">Populaire</span>
                                </div>
                                @endif

                                <div class="text-center mb-2">
                                    <h5 class="fw-bold text-capitalize mb-1">{{ $plan->name }}</h5>
                                    <p class="text-muted small">{{ $plan->description }}</p>
                                </div>

                                <!-- Pricing -->
                                <div class="text-center price-container mb-3">
                                    <div class="yearly-price">
                                        <span class="fs-3 fw-bold text-primary">
                                            {{ number_format($plan->price_yearly / 12, 0, ',', ' ') }}
                                        </span>
                                        <span class="text-muted small">Ar/mois</span>
                                        <div class="text-muted small">
                                            soit {{ number_format($plan->price_yearly, 0, ',', ' ') }} Ar/an
                                        </div>
                                    </div>
                                    <div class="monthly-price d-none">
                                        <span class="fs-3 fw-bold text-primary">
                                            {{ number_format($plan->price_monthly, 0, ',', ' ') }}
                                        </span>
                                        <span class="text-muted small">Ar/mois</span>
                                    </div>
                                </div>

                                <!-- Features -->
                                <div class="features-container">
                                    @forelse($plan->features as $feature)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ti ti-check text-primary me-2 small"></i>
                                        <span class="small text-body-secondary">{{ $feature }}</span>
                                    </div>
                                    @empty
                                    <p class="text-muted text-center small">Aucune fonctionnalité spécifiée</p>
                                    @endforelse
                                </div>

                                <!-- Action Button -->
                                <button type="button"
                                    class="btn {{ $plan->name === 'Solo+' ? 'btn-primary' : 'btn-outline-primary' }} btn-sm w-100 rounded-3 mt-3"
                                    wire:click="changePlan('{{ $plan->uuid }}')"
                                    data-bs-dismiss="modal">
                                    Choisir
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.modal-lg {
    max-width: 900px;
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.features-container {
    min-height: 180px;
}

.pricing-toggle-group .btn {
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
}

.pricing-toggle-group .btn-check:checked + .btn {
    background-color: var(--bs-primary);
    color: white;
}

.badge {
    font-size: 0.75rem;
}

@media (max-width: 768px) {
    .modal-body {
        padding: 1rem !important;
    }

    .features-container {
        min-height: auto;
    }

    .card {
        margin-bottom: 1rem;
    }

    .card:hover {
        transform: none;
    }
}

@media (max-width: 576px) {
    .modal-dialog {
        margin: 0.5rem;
    }

    .card-body {
        padding: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const yearlyRadio = document.getElementById('yearly');
    const monthlyRadio = document.getElementById('monthly');
    const yearlyPrices = document.querySelectorAll('.yearly-price');
    const monthlyPrices = document.querySelectorAll('.monthly-price');

    function togglePrices() {
        const isYearly = yearlyRadio.checked;
        yearlyPrices.forEach(el => el.classList.toggle('d-none', !isYearly));
        monthlyPrices.forEach(el => el.classList.toggle('d-none', isYearly));
    }

    yearlyRadio.addEventListener('change', togglePrices);
    monthlyRadio.addEventListener('change', togglePrices);

    // Initial state
    togglePrices();
});
</script>
</div>
