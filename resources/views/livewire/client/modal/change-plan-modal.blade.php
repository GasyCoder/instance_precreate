<!-- resources/views/livewire/change-plan-modal.blade.php -->
<div class="modal fade" id="changePlanModal" tabindex="-1" role="dialog" aria-labelledby="changePlanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePlanModalLabel">Changer de Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach($plans as $plan)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $plan->name }}
                            <button class="btn btn-primary" wire:click="selectPlan({{ $plan->id }})">Choisir</button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
