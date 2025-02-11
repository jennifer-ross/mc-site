/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
	content: [
		'./app/**/*.php',
		'./config/**/*.php',
		'./resources/**/*.{php,js}',
		'./storage/framework/views/*.php',
	],
	theme: {
		extend: {
			colors: {
				primary: {
					DEFAULT: 'var(--primary-color)',
					light: 'var(--primary-color)',
					dark: 'var(--primary-color)',
					50: '#4D4884',
					100: '#464176',
					200: '#3E3A69',
					300: '#36335C',
					400: '#2E2B45',
					500: '#272442',
					600: '#1F1D35',
					700: 'var(--primary-color)',
					800: '#0F0E1A',
					900: '#08070D',
				},
			},
			text: {

			},
			gridTemplateColumns: {
				// Column grid
				'16': 'repeat(16, minmax(0, 1fr))',
				'6': 'repeat(6, minmax(0, 1fr))',
				'4': 'repeat(4, minmax(0, 1fr))',
			},
			maxWidth: {
				'8xl': '96rem',
			},
			boxShadow: {
				'3lg': '0px 25px 35px 0 rgb(0 0 0 / 0.03), 0px 0px 5px 0 rgb(0 0 0 / 0.05)',
			},
			fontFamily: {
				"poppins": ['Poppins', 'sans-serif']
			}
		},
	},
	plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
