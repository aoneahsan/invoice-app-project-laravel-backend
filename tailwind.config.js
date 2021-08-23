const defaultTheme = require("tailwindcss/defaultTheme");
const DevelopmentMode = process.env.NODE_ENV == "development"

module.exports = {
    purge: {
        enabled: !DevelopmentMode,
        content: [
            "./vendor/laravel/jetstream/**/*.blade.php",
            "./storage/framework/views/*.php",
            "./resources/views/**/*.blade.php",
            "./resources/js/**/*.vue"
        ]
    },
    important: true,
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans]
            }
        }
    },

    variants: {
        opacity: ["responsive", "hover", "focus", "disabled"]
    },

    plugins: [require("@tailwindcss/ui")]
};
