import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/assets/**/*.{js,vue}',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'sans-serif', ...defaultTheme.fontFamily.sans],
                display: ['Space Grotesk', 'Poppins', ...defaultTheme.fontFamily.sans], // Bold, futuristic for headings
                code: ['Fira Code', ...defaultTheme.fontFamily.mono],
            },
            fontSize: {
                'heading-xl': ['3.5rem', { lineHeight: '1.2', fontWeight: '700' }], // Largest, bold headings (e.g., hero titles)
                'heading-lg': ['2.5rem', { lineHeight: '1.3', fontWeight: '600' }], // Main article or section titles
                'heading-md': ['1.875rem', { lineHeight: '1.4', fontWeight: '500' }], // Subheadings
                'body-lg': ['1.25rem', { lineHeight: '1.75', fontWeight: '400' }], // Primary body text
                'body-md': ['1.125rem', { lineHeight: '1.6', fontWeight: '400' }], // Secondary body text
                'body-sm': ['0.875rem', { lineHeight: '1.5', fontWeight: '400' }], // Small text (e.g., captions)
            },
            fontWeight: {
                hairline: 100,
                thin: 200,
                light: 300,
                normal: 400,
                medium: 500,
                semibold: 600,
                bold: 700,
                extrabold: 800,
                black: 900,
            },
            lineHeight: {
                tight: '1.1',
                snug: '1.3',
                normal: '1.6',
                relaxed: '1.8',
                loose: '2.1',
            },
            colors: {
                primary: {
                    DEFAULT: '#4A90E2', // Bright, elegant blue
                    '50': '#F0F7FF',
                    '100': '#D6E6FF',
                    '200': '#B3D1FF',
                    '300': '#8FB8FF',
                    '400': '#6A9FFF',
                    '500': '#4A90E2',
                    '600': '#357ABD',
                    '700': '#2B5D99',
                    '800': '#1F4274',
                    '900': '#13294F'
                },
                secondary: {
                    DEFAULT: '#FF6F61', // Warm coral for accents
                    '50': '#FFF3F2',
                    '100': '#FFE1DE',
                    '200': '#FFC2BC',
                    '300': '#FF9A92',
                    '400': '#FF7769',
                    '500': '#FF6F61',
                    '600': '#E65B50',
                    '700': '#C94A3F',
                    '800': '#A83C32',
                    '900': '#872D24'
                },
                // Light mode colors
                'light-bg': '#FFFFFF', // Light mode background
                'light-text': '#1A2B45', // Dark text for light mode
                'light-muted': '#6B7280', // Muted gray for light mode
                'light-border': '#E5E7EB', // Light mode border

                // Dark mode colors
                'dark-bg': '#0D1B2A', // Deep, luxurious dark navy background
                'dark-text': '#D9E6F2', // Light text for dark mode
                'dark-muted': '#8899A6', // Muted gray for dark mode
                'dark-border': '#2D3F54', // Dark mode border
            },
            spacing: {
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
            },
            borderRadius: {
                'xl': '1rem',
                '2xl': '1.5rem',
                '3xl': '2rem',
            },
            boxShadow: {
                'glow': '0 0 20px rgba(74, 144, 226, 0.3)', // Elegant glow effect for buttons or cards
                'card': '0 8px 20px rgba(0, 0, 0, 0.1), 0 4px 10px rgba(0, 0, 0, 0.06)',
                'hover': '0 10px 25px rgba(0, 0, 0, 0.15)',
            },
            transitionProperty: {
                'all': 'all',
                'height': 'height',
                'width': 'width',
                'opacity': 'opacity',
                'transform': 'transform',
                'background-color': 'background-color',
                'color': 'color',
            },
            transitionDuration: {
                '200': '200ms',
                '300': '300ms',
                '400': '400ms',
                '500': '500ms',
            },
            transitionTimingFunction: {
                'ease-in-out': 'cubic-bezier(0.4, 0, 0.2, 1)',
                'ease-out': 'cubic-bezier(0, 0, 0.2, 1)',
                'ease-in': 'cubic-bezier(0.4, 0, 1, 1)',
            },
        },
    },

    plugins: [
        forms,
        typography,
        plugin(({ addUtilities, addComponents, theme }) => {
            addUtilities({
                '.glass-effect': {
                    'background': 'rgba(255, 255, 255, 0.05)',
                    'backdrop-filter': 'blur(12px)',
                    '-webkit-backdrop-filter': 'blur(12px)',
                    'border': '1px solid rgba(255, 255, 255, 0.05)',
                },
                '.text-shadow': {
                    'text-shadow': '2px 2px 6px rgba(0, 0, 0, 0.2)',
                },
                '.text-shadow-sm': {
                    'text-shadow': '1px 1px 3px rgba(0, 0, 0, 0.1)',
                },
                '.gradient-text': {
                    'background': 'linear-gradient(45deg, #4A90E2, #FF6F61)',
                    '-webkit-background-clip': 'text',
                    'background-clip': 'text',
                    'color': 'transparent',
                },
            });

            addComponents({
                '.btn': {
                    padding: `${theme('spacing.3')} ${theme('spacing.6')}`,
                    borderRadius: theme('borderRadius.2xl'),
                    fontWeight: theme('fontWeight.medium'),
                    transition: 'all 0.3s ease-in-out',
                },
                '.btn-primary': {
                    backgroundColor: theme('colors.primary.500'),
                    color: theme('colors.white-text'),
                    boxShadow: theme('boxShadow.glow'),
                    '&:hover': {
                        backgroundColor: theme('colors.primary.600'),
                        transform: 'translateY(-3px)',
                        boxShadow: theme('boxShadow.hover'),
                    },
                    '&:active': {
                        transform: 'translateY(1px)',
                    },
                },
                '.btn-secondary': {
                    backgroundColor: 'transparent',
                    color: theme('colors.secondary.500'),
                    border: `2px solid ${theme('colors.secondary.500')}`,
                    '&:hover': {
                        backgroundColor: theme('colors.secondary.100'),
                        borderColor: theme('colors.secondary.600'),
                    },
                    '&:dark': {
                        color: theme('colors.secondary.300'),
                        borderColor: theme('colors.secondary.300'),
                        '&:hover': {
                            backgroundColor: theme('colors.dark-bg'),
                            borderColor: theme('colors.secondary.400'),
                        },
                    },
                },
                '.card': {
                    backgroundColor: theme('colors.dark-bg'),
                    borderRadius: theme('borderRadius.2xl'),
                    boxShadow: theme('boxShadow.card'),
                    padding: theme('spacing.8'),
                    transition: 'all 0.4s ease-in-out',
                    '&:hover': {
                        transform: 'translateY(-4px)',
                        boxShadow: theme('boxShadow.hover'),
                    },
                    '&:dark': {
                        backgroundColor: theme('colors.dark-bg'),
                    },
                    '&:light': {
                        backgroundColor: theme('colors.light-bg'),
                    },
                },
            });
        }),
    ],

    //prefix: 'tw-',
    important: true,
    darkMode: 'class',
};
