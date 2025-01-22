module.exports = {
  content: [
    './iot/**/*.{html,js}', // Adjusted this path to include the correct directory
  ],
  theme: {
    extend: {
      fontFamily: {
        yekanbold: ['yekanbold', 'sans-serif'],
        yekanlight: ['yekanlight', 'sans-serif'],
        yekanregular: ['yekanregular', 'sans-serif'],
        yekanblack: ['yekanblack', 'sans-serif'],
      },
      backgroundImage: {
        'custom-gradient': 'linear-gradient(0deg, #FFFFFF 0%, #FFFFFF 30%)',
      },
    },
  },
  plugins: [],
};
