{{-- views/livewire/client/messages/styleLoader.blade.php --}}
<style>
    .sk-wave {
        @apply tw-w-24 tw-h-14 tw-flex tw-justify-between tw-mx-auto;
    }

    .sk-wave-rect {
        @apply tw-bg-primary-600 tw-h-full tw-w-[15%];
        animation: sk-wave 1.2s infinite ease-in-out;
    }

    .sk-wave-rect:nth-child(1) { animation-delay: -1.2s; }
    .sk-wave-rect:nth-child(2) { animation-delay: -1.1s; }
    .sk-wave-rect:nth-child(3) { animation-delay: -1.0s; }
    .sk-wave-rect:nth-child(4) { animation-delay: -0.9s; }
    .sk-wave-rect:nth-child(5) { animation-delay: -0.8s; }

    @keyframes sk-wave {
        0%, 40%, 100% { transform: scaleY(0.4); }
        20% { transform: scaleY(1.0); }
    }

    .loading-overlay {
        @apply tw-fixed tw-inset-0 tw-flex tw-items-center tw-justify-center tw-bg-white/80 dark:tw-bg-gray-900/80 tw-backdrop-blur-sm tw-z-50;
    }

    .loading-container {
        @apply tw-bg-white dark:tw-bg-gray-800 tw-rounded-xl tw-shadow-2xl tw-p-8 tw-max-w-sm tw-w-full tw-mx-4;
    }

    .loading-text {
        @apply tw-text-lg tw-font-medium tw-text-gray-900 dark:tw-text-white tw-mt-4;
    }

    .waiting-text {
        @apply tw-text-sm tw-text-gray-500 dark:tw-text-gray-400 tw-mt-2;
    }

    .step-container {
        @apply tw-mt-6 tw-space-y-4;
    }

    .step-item {
        @apply tw-flex tw-items-center tw-justify-between tw-px-4 tw-py-2 tw-bg-gray-50 dark:tw-bg-gray-700/50 tw-rounded-lg;
    }

    .step-text {
        @apply tw-flex tw-items-center tw-gap-3 tw-text-sm tw-text-gray-600 dark:tw-text-gray-300;
    }

    .step-icon {
        @apply tw-w-5 tw-h-5 tw-text-primary-500;
    }

    .step-pending {
        @apply tw-opacity-50;
    }
</style>
