import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js'
    ],

    theme: {
        extend: {
            fontFamily: {
                'sans': ['Inter', 'Arial', 'sans-serif']
            },
            fontWeight: {
                hairline: 100,
                'extra-light': 100,
                thin: 200,
                 light: 300,
                 normal: 400,
                 medium: 500,
                semibold: 600,
                 bold: 700,
                extrabold: 800,
                'extra-bold': 800,
                 black: 900,
               }
        },
    },

       plugins: [
        require('flowbite/plugin')
    ],
};
