<div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-700 rounded-2xl overflow-hidden shadow-xl relative">
    <div class="p-8 text-white">
        <div class="space-y-4 max-w-2xl">
            @if($isUpgrade && $currentInstance)
                <!-- Section Mise à niveau instance existante -->
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 text-white text-sm font-medium backdrop-blur-sm">
                    ⚡ Options de mise à niveau
                </span>

                <div class="space-y-2">
                    <h2 class="text-2xl font-bold">Passez à la version payante</h2>
                    <p class="text-white/90">
                        Instance actuelle : {{ $currentInstance->remainingTrialDays }} jours restants d'essai
                    </p>
                </div>

                <!-- Information Instance en cours -->
                <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 rounded-lg bg-white/20 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-medium block">{{ $currentInstance->name }}.erpinnov.com</span>
                            <span class="text-sm text-white/80">Mise à niveau de l'instance</span>
                        </div>
                    </div>
                </div>

                <!-- Bouton de mise à niveau -->
                <button
                    x-data=""
                    x-on:click="$dispatch('open-payment-modal')"
                    class="w-full inline-flex items-center justify-center px-6 py-4 bg-white text-blue-600 rounded-xl font-medium hover:bg-blue-50 transition-all duration-300">
                    <span class="text-lg font-semibold">Mettre à niveau maintenant</span>
                </button>

            @else
                <!-- Section Nouvelle Instance -->
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 text-white text-sm font-medium backdrop-blur-sm">
                    ✨ Choisissez votre option
                </span>

                <div class="space-y-2">
                    <h2 class="text-3xl font-bold">Comment souhaitez-vous commencer ?</h2>
                    <p class="text-lg text-white/90">Démarrez avec un essai gratuit ou créez directement votre instance</p>
                </div>

                <!-- Options de démarrage -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <!-- Option Nouvel Abonnement -->
                    <div class="rounded-xl border-2 border-white/20 p-6 hover:bg-white/5 transition-all">
                        <h3 class="text-xl font-semibold mb-2">Créer une nouvelle instance</h3>
                        <p class="text-white/80 mb-4">Commencez immédiatement avec toutes les fonctionnalités</p>
                        <button
                            x-data=""
                            x-on:click="$dispatch('open-payment-modal')"
                            class="w-full inline-flex items-center justify-center px-6 py-4 bg-white text-blue-600 rounded-xl font-medium hover:bg-blue-50">
                            <span>S'abonner maintenant</span>
                        </button>
                    </div>

                    <!-- Option Essai Gratuit -->
                    @if(!$hasUsedTrial)
                    <div class="rounded-xl border-2 border-white/20 p-6 hover:bg-white/5 transition-all">
                        <h3 class="text-xl font-semibold mb-2">Essayer gratuitement</h3>
                        <p class="text-white/80 mb-4">Testez pendant 14 jours sans engagement</p>
                        <button
                            wire:click="startTrial"
                            class="w-full inline-flex items-center justify-center px-6 py-4 bg-transparent border-2 border-white text-white rounded-xl hover:bg-white/10">
                            <span>Démarrer l'essai</span>
                        </button>
                    </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
