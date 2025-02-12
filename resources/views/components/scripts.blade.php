@stack('scripts')
<script src="{{ asset('js/vendors/lazyload.min.js') }}"></script>
<script>
	window.modalsToInit = []
	document.addEventListener('DOMContentLoaded', e => {
		window.lazyLoadInstance = new LazyLoad({});
	})

	const observeDOM = (function() {
		let MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

		return function(obj, callback) {
			if (!obj || obj.nodeType !== 1) {
				return;
			}

			if (MutationObserver) {
				// define a new observer
				let mutationObserver = new MutationObserver(callback);

				// have the observer observe for changes in children
				mutationObserver.observe(obj, {childList: true, subtree: true});
				return mutationObserver;
			} else if (window.addEventListener) { // browser support fallback
				obj.addEventListener('DOMNodeInserted', callback, false);
				obj.addEventListener('DOMNodeRemoved', callback, false);
			}
		}
	})();
	window.observeDOM = observeDOM

	observeDOM(document.body, e => {
		if (window.lazyLoadInstance) {
			window.lazyLoadInstance.update();
		}
	})
</script>
