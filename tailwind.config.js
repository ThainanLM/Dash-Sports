/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./**/*.{html,js,php}","./node_modules/flowbite/**/*.js"],
  theme: {
    screens:{
      sm:'576px',
      md:'768px',
      lg:'992px',
      xl:'1200',
    },
    container:{
      center: true,
      padding: '1rem'
    },
    extend: {                   
      fontFamily:{
      bebas: "'Bebas Neue', sans-serif",
      roboto: "'Roboto', sans-serif",
      },
      colors:{
      'primary':'#19DE5D',
      'second':'#1bb454',
      dark: {
        100: '#0007', // Exemplo de uma cor para o modo escuro
        // Defina outras cores de acordo com sua preferência
      },
      },
      keyframes: {
        shake: {
          '0%, 100%': { transform: 'translateX(0)' },
          '25%': { transform: 'translateX(-5px)' },
          '50%': { transform: 'translateX(5px)' },
          '75%': { transform: 'translateX(-5px)' },
        },
      },
      animation: {
        shake: 'shake 0.5s',
      },
    },
  },
  plugins: [require('flowbite/plugin')],
    darkMode: "class",
    tailwindcss: {},
    autoprefixer: {},
    
  };