const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    50: "f9c1b4",
                    100: "#f6a38e",
                    200: "#f5937b",
                    300: "#f38469",
                    400: "#f27456",
                    500: "#f06543", // PRIMARY
                    600: "#d85b3c",
                    700: "#c05136",
                    800: "#a8472f",
                    900: "#903d28",
                },
            },

            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            },

            backgroundImage: {
                "homepage-banner-bg": "url('/images/home_banner_bg.png')",
            },

            boxShadow: {
                "title-link": "inset 0 0 0 0.03px white",
                "title-link-hover": "inset 425px 0 0 0 #f06543",
            },

            transitionProperty: {
                width: "width",
                "border-color": "border-color",
                "box-shadow": "box-shadow",
                "border-color-shadow": "border-color, box-shadow",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
