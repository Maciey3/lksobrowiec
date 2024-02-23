const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // keyframes: {
            //     unwrap1: {
            //       '0%': { width: '0%' },
            //       '100%': { width: '100%' },
            //     }
            // },
            // animation: {
            //     unwrap2: 'unwrap1 1s linear',
            // }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
