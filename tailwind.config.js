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
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Space Grotesk"', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                obsidian: {
                    950: '#07090d',
                    900: '#0b0e14',
                    850: '#0f131b',
                    800: '#131822',
                    750: '#181e2b',
                    700: '#1f2737',
                },
                mint: {
                    300: '#8ef8db',
                    400: '#5ef0c8',
                    500: '#3edbb3',
                    600: '#24b592',
                },
            },
            boxShadow: {
                'mint-glow': '0 0 32px -6px rgba(94, 240, 200, 0.35)',
                'mint-soft': '0 0 60px -15px rgba(94, 240, 200, 0.22)',
            },
        },
    },

    plugins: [forms],
};
