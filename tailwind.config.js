const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Calibri", ...defaultTheme.fontFamily.sans],
                serif: ["Garamond", ...defaultTheme.fontFamily.serif],
                mono: ["ui-monospace", ...defaultTheme.fontFamily.mono],
            },
            colors: {
                blueGray: colors.slate,
                primary: {
                    50: "rgb(255,247,237)",
                    100: "rgb(255,237,213)",
                    200: "rgb(254,215,170)",
                    300: "rgb(253,186,116)",
                    400: "rgb(251,146,60)",
                    500: "rgb(231,101,6)",
                    600: "rgb(234,88,12)",
                    700: "rgb(194,65,12)",
                    800: "rgb(154,52,18)",
                    900: "rgb(124,45,18)",
                },
                danger: colors.red,
                warning: colors.amber,
                secondary: colors.blue,
                success: colors.green,
            },
            backgroundImage: {
                dot: "url('/images/dot.svg')",
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
