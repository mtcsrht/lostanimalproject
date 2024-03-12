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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'lightmode': "url('/resources/images/bg-white.svg')",
                'darkmode': "url('/resources/images/bg-dark.svg')",
                'waves-lightmode': "url('/resources/images/bg-waves-light.svg')",
                'waves-darkmode': "url('/resources/images/bg-waves-dark.svg')",
                'mobile-waves-lightmode': "url('/resources/images/bg-mobile-waves-light.svg')",
                'mobile-waves-darkmode': "url('/resources/images/bg-mobile-waves-dark.svg')",
                
              },
        },
    },

    plugins: [
        forms
    ],
};
