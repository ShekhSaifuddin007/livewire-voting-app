const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',

                black: colors.black,
                white: colors.white,
                gray: colors.trueGray,
                teal: colors.teal
            },
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
                lobster: ['Lobster', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: ['0.625rem', { lineHeight: '1rem' }]
            },
            minHeight: {
                13: '3.125rem',
            },
            spacing: {
                22: '5.5rem',
                104: '26rem',
                76: '19rem',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
