<div class="flex items-center justify-center relative"
	 x-data="{
        loaded: false,
        init() {
            const iframe = this.$refs.discordIframe;
            iframe.addEventListener('load', () => {
				this.loaded = true;
            });
{{--            iframe.src = iframe.dataset.src;--}}
        }
     }"
>
	<template x-if="!loaded">
		<x-ui.loader/>
	</template>
	<iframe
		x-transition
		x-ref="discordIframe"
		x-bind:class="loaded ? 'opacity-100' : ''"
		class="lazy max-w-sm transition-all duration-400 ease opacity-0"
		data-src="https://discord.com/widget?id=820370652242116644&theme=dark"
		src="#"
		width="100%"
		height="400"
		allowtransparency="true"
		frameborder="0"
		sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
	></iframe>
</div>
