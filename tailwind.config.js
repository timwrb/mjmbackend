/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/livewire/**/*.blade.php',
    ],
  theme: {
    extend: {
        colors: {

            darkGrey100: '#252323',
            darkGrey60: 'rgba(37, 35, 35, 0.6)', // 60% opacity
            darkGrey40: 'rgba(37, 35, 35, 0.4)', // 40% opacity

            customBlue: '#4A7D91',
            customBlueDarker: '#6ccff6',

            customBrown: '#887B69',
            customBrownDarker: '#C3A16F',

            almostBlack: '#0f0f0f',
            almostWhite: '#F7F7F7',

            customBlue10: '#F0FAFE',
            customBlue20: '#E2F5FD',

            companyDarkGrey: '#181818',
            companyLightGrey: '#282727',
            companyBorderGrey: '#525151',
        }
    },
  },
  plugins: [],
}

