import defaultTheme from "tailwindcss/defaultTheme";
import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                background: {
                    100: "#F0F3F5",
                    150: "#E4E4E4",
                    200: "#DBDBDB",
                    300: "#A9A9A9",
                },
                cta: {
                    100: "#2FD6DC",
                    200: "#2FB1DC",
                    300: "#2F91DC",
                },
                alert: {
                    success: {
                        100: "#37CD78",
                        200: "#1EA054",
                        300: "#007F35",
                    },
                    danger: "#F72F07",
                    warning: {
                        100: "#F7A707",
                        200: "#F77307",
                    },
                },
                primary: {
                    50: "#bddbf1",
                    100: "#4A9DD8",
                    200: "#498CD8",
                    300: "#4955D8",
                },
                secondary: {
                    100: "#7B42F6",
                    200: "#6534CD",
                    300: "#46268C",
                },
                textcolor: {
                    darkmode: "#FFFFFF",
                    lightmode: "#000000",
                    placeholder: "#A9A9A9",
                    outlinedbutton: "#4A9DD8",
                },
            },
            fontFamily: {
                poppinsRegular: ["Poppins-Regular", "sans-serif"],
                poppinsSemiBold: ["Poppins-SemiBold", "sans-serif"],
            },
            boxShadow: {
                button: {
                    black: "0px 10px 20px rgba(0, 0, 0, 0.15)",
                    hover: "0px 15px 30px rgba(0, 0, 0, 0.25)",
                },
                card: {
                    black: "0px 20px 40px rgba(0, 0, 0, 0.15)",
                    hover: "0px 30px 60px rgba(0, 0, 0, 0.25)",
                },
            },
            borderRadius: {
                secondary_btn: "10px",
                image: "14px",
                cards: "20px",
                button: "30px",
            },
            fontSize: {
                h1: ["80px", { lineHeight: "auto" }],
                h2: ["60px", { lineHeight: "auto" }],
                h3: ["30px", { lineHeight: "auto" }],
                h4: ["24px", { lineHeight: "auto" }],
                largeText: ["24px", { lineHeight: "180%" }],
                mediumText: ["20px", { lineHeight: "180%" }],
                normalText: ["16px", { lineHeight: "180%" }],
                smallText: ["12px", { lineHeight: "180%" }],
                lessTinyText: ["10px", { lineHeight: "180%" }],
                tinyText: ["8px", { lineHeight: "180%" }],
            },
        },
    },
    plugins: [],
};
