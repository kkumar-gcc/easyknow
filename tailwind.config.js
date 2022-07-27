/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");

module.exports = {
    mode: 'jit',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/**/**/*.blade.php",
        "./resources/**/**/**/**/*.blade.php",
        "./resources/**/**/**/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: 'class',
    theme: {
        colors: {
            transparent: "transparent",
            current: "currentColor",
            black: colors.black,
            blue: colors.blue,
            cyan: colors.cyan,
            emerald: colors.emerald,
            fuchsia: colors.fuchsia,
            gray: colors.neutral,
            blueGray: colors.slate,
            coolGray: colors.gray,
            warmGray: colors.stone,
            green: colors.green,
            indigo: colors.indigo,
            lime: colors.lime,
            orange: colors.orange,
            pink: colors.pink,
            purple: colors.purple,
            red: colors.red,
            rose: colors.rose,
            sky: colors.sky,
            teal: colors.teal,
            violet: colors.violet,
            yellow: colors.amber,
            white: colors.white,
            gray:colors.gray,
            zinc:colors.zinc,
            stone:colors.stone,
            neutral:colors.neutral
        },
        extend: {
            display: ["group-hover"],
        },
    },
    // prefix: 'tw-',
    plugins: [
        require('flowbite/plugin'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
