module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      animation: {
        'fade-in-down': "fade-in-down 0.2s ease-in-out both"
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
