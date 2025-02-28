<!-- Modal Détails Instance -->
<div wire:ignore.self class="modal fade" data-bs-backdrop="static" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            @if($selectedInstance)
                <div class="modal-header border-0 p-4">
                    <div>
                        <h5 class="modal-title fw-semibold mb-1">
                            Détails de l'instance
                        </h5>
                        <p class="text-muted small mb-0">
                            Référence : {{ $selectedInstance->reference }}
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="location.reload();"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- URL de l'instance -->
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted small mb-1">URL de l'instance</p>
                                <p class="mb-0 fw-medium">{{ $selectedInstance->url }}</p>
                            </div>
                            <a href="{{ $selectedInstance->url }}"
                               target="_blank"
                               class="btn btn-primary btn-sm rounded-3">
                                <i class="ti ti-external-link me-1"></i>
                                Accéder
                            </a>
                        </div>
                    </div>

                    <!-- Informations principales -->
                    <div class="row g-4">
                        <div class="col-6">
                            <p class="text-muted small mb-1">Entreprise</p>
                            <p class="fw-medium mb-0">{{ $selectedInstance->entreprise->name }}</p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted small mb-1">Identifiant</p>
                            <p class="fw-medium mb-0">{{ $selectedInstance->dolibarr_username }}</p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted small mb-1">Localisation</p>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('assets/img/flags/' . ($selectedInstance->pays === 0 ? '0.png' : '1.png')) }}"
                                     alt="Drapeau"
                                     width="20"
                                     class="rounded">
                                <span class="fw-medium">{{ $selectedInstance->getPaysNomAttribute() }}</span>
                            </div>
                        </div>

                        <div class="col-6">
                            <p class="text-muted small mb-1">Statut</p>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">
                                {{ $selectedInstance->status === 'active' ? 'Opérationnel' : 'En pause' }}
                            </span>
                        </div>

                        <div class="col-6">
                            <p class="text-muted small mb-1">Date de création</p>
                            <p class="fw-medium mb-0">{{ Carbon\Carbon::parse($selectedInstance->created_at)->format('d/m/Y') }}</p>
                        </div>

                        <div class="col-6">
                            <p class="text-muted small mb-1">Plan actuel</p>
                            <p class="fw-medium mb-0">{{ $selectedInstance->subscription->plan->name }}</p>
                        </div>
                    </div>

                    <!-- État de l'abonnement -->
                    <div class="alert alert-light rounded-3 mt-4 mb-0">
                        <div class="d-flex gap-3">
                            <i class="ti ti-calendar text-primary"></i>
                            <div>
                                <p class="fw-medium mb-1">État de l'abonnement</p>
                                <p class="text-muted small mb-0">
                                    Expire le {{ Carbon\Carbon::parse($selectedInstance->subscription->end_date)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <div class="d-flex gap-2">
                        @if(!$selectedInstance->subscription->plan->is_free)
                            <a href="{{ route('client.facture', ['instance' => $selectedInstance->id]) }}"
                               class="btn btn-info rounded-3">
                                <i class="ti ti-receipt me-1"></i>
                                Voir la facturation
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:initialized', function () {
    const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));

    Livewire.on('show-detail-modal', () => {
        detailModal.show();
    });

    Livewire.on('close-detail-modal', () => {
        detailModal.hide();
    });

    document.getElementById('detailModal').addEventListener('hidden.bs.modal', function () {
        @this.closeModal();
    });
});
</script>
@endpush
