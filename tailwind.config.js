const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                realty: {
                    light: '#5599fb',
                    DEFAULT: '#4792fd',
                    dark: '#3687fb',
                }
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '150': '150px',
            },
            zIndex: {
                '-10': '-10',
            },
            inset: {
                '-10': '-10px',
                '-15': '-15px',
                '-20': '-20px',
                '-25': '-25px',
                '-30': '-30px',
                '-35': '-35px',
                '-40': '-40px',
                '-50': '-50px',
                '-60': '-60px',
                '-65': '-65px',
                '-70': '-70px',
                '-75': '-75px',
                '-80': '-80px',
                '-85': '-85px',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    // plugins: [require('@tailwindcss/forms')],
};
