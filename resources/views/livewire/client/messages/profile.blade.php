<div>
    <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Notifications -->

   

            <div class="row">
                <!-- Colonne gauche: Informations personnelles -->
                <div class="col-lg-8">
                    <!-- Photo de profil -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Photo de profil</h5>
                            @if($photo)
                                <button type="button"
                                        class="btn btn-primary btn-sm"
                                        wire:click="updatePhoto">
                                    <i class="ti ti-device-floppy me-1"></i>
                                    Enregistrer
                                </button>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-4">
                                <!-- Aperçu de la photo -->
                                <div class="preview-area">
                                    <div class="avatar avatar-xl">
                                        @if($photo)
                                            <img src="{{ $photo->temporaryUrl() }}"
                                                 alt="Aperçu"
                                                 class="rounded-circle">
                                        @elseif($user->profile_photo_url)
                                            <img src="{{ $user->profile_photo_url }}"
                                                 alt="{{ $user->name }}"
                                                 class="rounded-circle">
                                        @else
                                            <div class="avatar-initial rounded-circle bg-primary">
                                                {{ $user->initials }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Zone d'upload -->
                                <div class="flex-grow-1">
                                    <div class="upload-actions d-flex flex-wrap gap-3">
                                        <!-- Bouton d'upload -->
                                        <div class="upload-btn-wrapper">
                                            <input type="file"
                                                   wire:model="photo"
                                                   class="d-none"
                                                   id="upload-photo"
                                                   accept="image/*">
                                            <label for="upload-photo" class="btn btn-outline-primary mb-0">
                                                <i class="ti ti-upload me-1"></i>
                                                Changer la photo
                                            </label>
                                        </div>

                                        <!-- Bouton de suppression -->
                                        @if($user->profile_photo_url)
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-sm"
                                                    wire:click="deletePhoto"
                                                    wire:confirm="Êtes-vous sûr de vouloir supprimer votre photo de profil ?">
                                                <i class="ti ti-trash me-1"></i>
                                                Supprimer
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Messages d'aide et d'erreur -->
                                    <div class="mt-2">
                                        @if($photo)
                                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                                <i class="ti ti-info-circle me-2"></i>
                                                Cliquez sur "Enregistrer" pour valider votre nouvelle photo
                                            </div>
                                        @endif

                                        <div class="text-muted mt-1">
                                            <small>
                                                <i class="ti ti-file-description me-1"></i>
                                                Formats acceptés : JPG, PNG ou GIF (Max. 1Mo)
                                            </small>
                                        </div>

                                        @error('photo')
                                            <div class="text-danger mt-1">
                                                <small>
                                                    <i class="ti ti-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Indicateur de chargement -->
                                    <div wire:loading wire:target="photo, updatePhoto" class="mt-2">
                                        <div class="spinner-border spinner-border-sm text-primary me-1" role="status">
                                            <span class="visually-hidden">Chargement...</span>
                                        </div>
                                        <small class="text-muted">Traitement en cours...</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations de base -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Informations personnelles</h5>
                                <button type="button" class="btn btn-primary btn-sm" wire:click="updateProfile">
                                    Sauvegarder
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit="updateProfile">
                                <!-- Nom -->
                                <div class="mb-3">
                                    <label class="form-label">Nom complet</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           wire:model="name"
                                           placeholder="Votre nom">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           wire:model="email"
                                           placeholder="votre@email.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Changement de mot de passe -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Changer le mot de passe</h5>
                                <button type="button" class="btn btn-primary btn-sm" wire:click="updatePassword">
                                    Mettre à jour
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit="updatePassword">
                                <!-- Mot de passe actuel -->
                                <div class="mb-3">
                                    <label class="form-label">Mot de passe actuel</label>
                                    <input type="password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           wire:model="current_password">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nouveau mot de passe -->
                                <div class="mb-3">
                                    <label class="form-label">Nouveau mot de passe</label>
                                    <input type="password"
                                           class="form-control @error('new_password') is-invalid @enderror"
                                           wire:model="new_password">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirmation -->
                                <div class="mb-3">
                                    <label class="form-label">Confirmer le mot de passe</label>
                                    <input type="password"
                                           class="form-control"
                                           wire:model="new_password_confirmation">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="col-lg-4">
                    <!-- Plan actuel -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Plan actuel</h5>
                        </div>
                        <div class="card-body">
                            @if($activePlan)
                                <div class="d-flex align-items-start gap-3">
                                    <div class="avatar avatar-md bg-primary-subtle">
                                        <i class="ti ti-package text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $activePlan->name }}</h6>
                                        <p class="text-muted mb-0">
                                            {{ $activePlan->description }}
                                        </p>
                                        <div class="mt-2">
                                            <span class="badge bg-success-subtle text-success">
                                                {{ $remainingInstances }} instances restantes
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid mt-3">
                                    <a href="{{ route('client.facture') }}" class="btn btn-outline-primary">
                                        <i class="ti ti-credit-card me-2"></i>
                                        Gérer mon abonnement
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <div class="avatar avatar-md bg-warning-subtle mb-3">
                                        <i class="ti ti-alert-triangle text-warning"></i>
                                    </div>
                                    <h6>Aucun plan actif</h6>
                                    <p class="text-muted">Activez un plan pour profiter de nos services</p>
                                    <a href="{{ route('client.facture') }}" class="btn btn-primary">
                                        <i class="ti ti-plus me-2"></i>
                                        Voir les plans
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Statistiques du compte</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="avatar avatar-md bg-info-subtle">
                                    <i class="ti ti-building text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $user->entreprises->count() }}</h6>
                                    <small class="text-muted">Entreprises créées</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="avatar avatar-md bg-success-subtle">
                                    <i class="ti ti-server text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $user->instances->count() }}</h6>
                                    <small class="text-muted">Instances actives</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar avatar-md bg-primary-subtle">
                                    <i class="ti ti-calendar text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $user->created_at->format('d/m/Y') }}</h6>
                                    <small class="text-muted">Membre depuis</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
        /* Avatar styles */
        .avatar {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-xl {
            width: 110px;
            height: 110px;
        }

        .avatar-lg {
            width: 48px;
            height: 48px;
        }

        .avatar-md {
            width: 36px;
            height: 36px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 1.2rem;
            color: white;
        }

        /* Upload area styles */
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .preview-area {
            position: relative;
        }

        .preview-area::after {
            content: '';
            position: absolute;
            inset: -4px;
            border: 2px solid var(--bs-primary);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .preview-area:hover::after {
            opacity: 0.5;
        }

        /* Card styles */
        .card {
            border-radius: 0.75rem;
            border: 1px solid rgba(0,0,0,0.125);
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.125);
            padding: 1.25rem;
        }

        /* Background styles */
        .bg-primary-subtle {
            background-color: rgba(99, 102, 241, 0.1) !important;
        }

        .bg-success-subtle {
            background-color: rgba(34, 197, 94, 0.1) !important;
        }

        .bg-warning-subtle {
            background-color: rgba(234, 179, 8, 0.1) !important;
        }

        .bg-info-subtle {
            background-color: rgba(6, 182, 212, 0.1) !important;
        }

        /* Text colors */
        .text-primary {
            color: #6366F1 !important;
        }

        .text-success {
            color: #22C55E !important;
        }

        .text-warning {
            color: #EAB308 !important;
        }

        .text-info {
            color: #06B6D4 !important;
        }

        /* Button styles */
        .btn-primary {
            background-color: #6366F1;
            border-color: #6366F1;
        }

        .btn-primary:hover {
            background-color: #4F46E5;
            border-color: #4F46E5;
        }

        .btn-outline-primary {
            color: #6366F1;
            border-color: #6366F1;
        }

        .btn-outline-primary:hover {
            background-color: #6366F1;
            border-color: #6366F1;
        }

        /* Animation styles */
        .fade-enter-active,
        .fade-leave-active {
            transition: opacity 0.3s ease;
        }

        .fade-enter-from,
        .fade-leave-to {
            opacity: 0;
        }

        /* Loading indicator */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }

        /* Badge styles */
        .badge {
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 768px) {
            .avatar-xl {
                width: 90px;
                height: 90px;
            }

            .card-body {
                padding: 1rem;
            }

            .upload-actions {
                flex-direction: column;
                align-items: stretch;
            }
        }
        </style>

        <!-- Scripts pour les notifications -->
        <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('profile-updated', () => {
                showNotification('Profil mis à jour avec succès');
            });

            Livewire.on('photo-updated', () => {
                showNotification('Photo de profil mise à jour avec succès');
            });

            Livewire.on('password-updated', () => {
                showNotification('Mot de passe modifié avec succès');
            });
        });

        function showNotification(message) {
            // Si vous utilisez Bootstrap Toast
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            document.querySelector('.toast-body span').textContent = message;
            toast.show();
        }
        </script>

    <!-- Ajout des notifications -->
    <div>
        <!-- Notifications de succès -->
        <div x-data="{ show: false, message: '' }"
             x-on:profile-updated.window="show = true; message = 'Profil mis à jour avec succès'; setTimeout(() => show = false, 3000)"
             x-on:photo-updated.window="show = true; message = 'Photo de profil mise à jour'; setTimeout(() => show = false, 3000)"
             x-on:password-updated.window="show = true; message = 'Mot de passe modifié avec succès'; setTimeout(() => show = false, 3000)"
             x-show="show"
             x-transition.duration.300ms
             class="position-fixed top-0 end-0 p-3"
             style="z-index: 1050;">
            <div class="toast show bg-success text-white">
                <div class="toast-body d-flex align-items-center">
                    <i class="ti ti-check me-2"></i>
                    <span x-text="message"></span>
                </div>
            </div>
        </div>
    </div>
</div>
