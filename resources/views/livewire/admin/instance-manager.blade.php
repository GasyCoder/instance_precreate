<div class="container">
    <h2 class="mb-4">Gestion des Instances</h2>

    <!-- Statistiques -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Instances Libres</h5>
                    <h3>{{ $libres }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Instances Attribuées</h5>
                    <h3>{{ $attribues }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire d'ajout -->
    <div class="card mb-4">
        <div class="card-header">Ajouter une Instance</div>
        <div class="card-body">
            <form wire:submit.prevent="addInstance">
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <select name="" id="" class="form-control">
                    @foreach($instances as $instance)
                        @if($instance->statut == "libre")
                        <option value="{{ $instance->url }}">{{ $instance->url }}</option>
                        @endif
                    @endforeach
                    </select>
                    <input type="url" wire:model="url" id="url" class="form-control" placeholder="https://example.erpinnov.com">
                    @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" wire:model="password" id="password" class="form-control">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>

    <!-- Liste des instances -->
    <div class="card">
        <div class="card-header">Liste des Instances</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instances as $instance)
                    <tr>
                        <td><a href="{{ $instance->url }}" target="_blank">{{ $instance->url }}</a></td>
                        <td>
                            <span class="badge {{ $instance->statut == 'libre' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($instance->statut) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
