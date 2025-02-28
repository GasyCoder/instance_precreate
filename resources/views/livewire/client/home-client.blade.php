{{-- Modern Dashboard View with Pricing Plan --}}
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 pt-16 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Layout principal --}}
        <div class="grid lg:grid-cols-12 gap-8">
            {{-- Colonne principale --}}
            <div class="lg:col-span-12 space-y-12">
                {{-- Liste des instances --}}
                @include('livewire.client.sections.instance-listes')

                {{-- Composant Plan tarifaire --}}
                <div id="plan">
                    <livewire:payment.pricing-plan />
                </div>
            </div>
        </div>
    </div>
</div>
