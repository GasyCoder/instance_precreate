<button {{ $attributes->merge(['type' => 'submit', 'class' => '
    inline-flex items-center
    px-4 py-2
    bg-primary-600
    hover:bg-primary-700
    focus:bg-primary-700
    active:bg-primary-800
    border border-transparent
    rounded-lg
    font-medium
    text-sm
    text-white
    tracking-wide
    focus:outline-none
    focus:ring-2
    focus:ring-primary-500
    focus:ring-offset-2
    disabled:opacity-50
    transition-colors
    duration-200
    dark:bg-primary-500
    dark:hover:bg-primary-600
    dark:focus:bg-primary-600
    dark:active:bg-primary-700
']) }}>
    {{ $slot }}
</button>
