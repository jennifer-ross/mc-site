import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
	plugins: [
		laravel({
			input: [
				'resources/css/app.css',
				'resources/css/quill.snow.css',
				'resources/css/quill.mention.min.css',
				'resources/js/app.js',
				'resources/js/modules/lazyload.js',
				'resources/js/modules/echo.js',
				'resources/js/modules/chat.js',
				'resources/css/admin.css',
			],
			refresh: true,
		}),
	],
	resolve: {
		alias: {
			'@': '/resources/js',
		},
	},
})
