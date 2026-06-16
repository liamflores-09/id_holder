import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                gallery: '#FAFAFA',
                charcoal: '#111111',
                surface: '#F3F3F3',
                muted: '#707070',
            },
            borderRadius: {
                none: '0px',
            },
            letterSpacing: {
                editorial: '0.25em',
                wide: '0.2em',
            },
            animation: {
                'slide-in': 'slideIn 500ms cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                'fade-up': 'fadeUp 700ms cubic-bezier(0.25, 0.46, 0.45, 0.94)',
            },
            keyframes: {
                slideIn: {
                    '0%': { transform: 'translateX(-100%)' },
                    '100%': { transform: 'translateX(0)' },
                },
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },

    plugins: [forms],
};
