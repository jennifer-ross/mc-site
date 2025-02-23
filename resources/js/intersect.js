const Observer = {
	start() {
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', () => this.observe())

			return
		}

		this.observe()
	},

	observe() {
		const selectors = [
			'[class*=" intersect:"]',
			'[class*=":intersect:"]',
			'[class^="intersect:"]',
			'[class="intersect"]',
			'[class*=" intersect "]',
			'[class^="intersect "]',
			'[class$=" intersect"]',
		]

		document.querySelectorAll(selectors.join(',')).forEach(element => {
			let lastTime = -100

			const observer = new IntersectionObserver(entries => {
				entries.forEach(entry => {
					if (lastTime + 100 >= entry.time) {
						return
					}

					if (!entry.isIntersecting) {
						element.setAttribute('no-intersect', '')

						return
					}

					lastTime = entry.time
					element.removeAttribute('no-intersect')

					element.classList.contains('intersect-once') && observer.disconnect()
				})
			}, {
				threshold: this.getThreshold(element),
			})

			observer.observe(element)
		})
	},

	getThreshold(element) {
		if (element.classList.contains('intersect-full')) {
			return 0.99
		}

		if (element.classList.contains('intersect-half')) {
			return 0.5
		}

		return 0
	},
}

export { Observer }
