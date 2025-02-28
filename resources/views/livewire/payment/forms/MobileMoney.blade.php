{{-- resources/views/livewire/payment/forms/OrangeMoney.blade.php --}}
{{-- <form wire:submit.prevent="processPayment"
class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Numéro Orange Money</label>
        <input type="text" wire:model.defer="mobileNumber" placeholder="032 XX XXX XX" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('mobileNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700">
        Payer {{ number_format($this->calculateTotal(), 2) }}€
    </button>
</form> --}}
<form wire:submit.prevent="processPayment" class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro {{ $paymentMethod }}</label>
        <div class="relative">
            <input type="tel"
                wire:model.defer="mobileNumber"
                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                placeholder="03X XX XXX XX">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
            </div>
        </div>
        @error('mobileNumber') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <button type="submit" 
        class="w-full flex justify-center items-center px-6 py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
        <span wire:loading.remove>
            Payer {{ $showLocalPrice 
                ? number_format($this->calculateLocalTotal(), 0) . ' Ar' 
                : number_format($this->calculateTotal(), 2) . ' €' 
            }}
        </span>
        <span wire:loading class="flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Traitement en cours...
        </span>
    </button>
</form>