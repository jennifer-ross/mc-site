/** @type {DefaultColors} */

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
				lightblue: {
					DEFAULT: '#fff',
					light: '#fff',
					dark: '#fff',
					50: '#E4E9F7',
					100: '#E0E5F6',
					200: '#D0D9F1',
					300: '#C0CCEC',
					400: '#B0BFE8',
					500: '#A1B2E3',
					600: '#91A6De',
					700: '#8199D9',
					800: '#728CD5',
					900: '#627FD0',
				}
			},
			text: {},
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
				'3nlg': '0px 25px 35px 0 rgb(0 0 0 / 0.03)',
				'4lg': '0px 30px 60px 0 rgb(0.14901961386203766 0.20000000298023224 0.3019607961177826 / 0.03)'
			},
			fontFamily: {
				'poppins': ['Poppins', 'sans-serif'],
			},
		},
	},
	plugins: [
		require('@tailwindcss/forms'),
		require('@tailwindcss/typography'),
		require('tailwindcss-motion'),
		require('tailwindcss-intersect'),
	],
}
