/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/css/**/*.css",
  ],
  theme: {
    extend: {
        colors: {
            'main-color': '#54BD95',
        },
        fontFamily: {
            'jakarta-sans': ['Plus Jakarta Sans', 'sans-serif'],
            'inter': ['Inter', 'sans-serif'],
        }
    },
  },
  plugins: [],
}
