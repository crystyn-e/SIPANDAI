/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                // Warna utama tetap hijau emerald (dominan)
                primary: {
                    50: "#ecfdf5",
                    100: "#d1fae5",
                    200: "#a7f3d0",
                    300: "#6ee7b7",
                    400: "#34d399",
                    500: "#10b981",
                    600: "#059669", // Tombol utama
                    700: "#047857",
                    800: "#065f46",
                    900: "#064e3b",
                },
                // Hijau kebiruan (teal) untuk variasi ikon, badge, dan aksen pendukung
                tealish: {
                    50: "#f0fdfa",
                    100: "#ccfbf1",
                    200: "#99f6e4",
                    500: "#14b8a6",
                    600: "#0d9488",
                    700: "#0f766e",
                },
                // Aksen hangat (amber) secukupnya untuk highlight & status/peringatan ringan
                warm: {
                    50: "#fffbeb",
                    100: "#fef3c7",
                    200: "#fde68a",
                    400: "#fbbf24",
                    500: "#f59e0b",
                    600: "#d97706",
                    700: "#b45309",
                },
            },
            fontFamily: {
                sans: [
                    "Plus Jakarta Sans",
                    "ui-sans-serif",
                    "system-ui",
                    "sans-serif",
                ],
            },
        },
    },
    plugins: [],
};
