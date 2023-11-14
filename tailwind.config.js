import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'purple': '#bfa7bd',
                "gray-background": "#f7f8fc",
                blue: "#328af1",
                "blue-hover": "#2879bd",
                yellow: "#ffc73c",
                red: "#ec454f",
                green: "#1aab8b",
            },
            margin: {
                '30.25': '7.75rem'
            },
            spacing: {
                22: '5.5rem',
                70: "17.5rem",
                76: '19rem',
                104: '26rem',
                175: "43.75rem",
            },
            maxWidth: {
                custom: "68.5rem",
            },
            screens: {
                'xs': '460px'
            }
        },
    },
    plugins: [forms, typography],
};
