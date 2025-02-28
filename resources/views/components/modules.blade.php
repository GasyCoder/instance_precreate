@props(['modules'])

<ul class="p-0 m-0">
    @foreach($modules as $key => $module)
    <li class="mb-3 d-flex align-items-start">
        <div class="p-2 rounded badge bg-label-info me-3">
            <i class="ti ti-file-text ti-md"></i>
        </div>
        <div class="d-flex justify-content-between w-100">
            <div class="me-2">
                <h6 class="mb-0">{{ $module['name'] }}</h6>
                <small class="text-muted">{{ $module['description'] }}</small>
            </div>
            <div class="d-flex align-items-center">
                <div class="form-check form-check-inline">
                    <input wire:model="modules.{{ $key }}.selected" class="form-check-input" type="checkbox" id="{{ $key }}" />
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul>