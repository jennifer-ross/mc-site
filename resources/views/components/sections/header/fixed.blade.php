<header class="shadow bg-glass backdrop-blur w-full sticky top-0 left-0 z-20 border-b border-b-[rgba(255,255,255,.15)]">
	<x-container class="bg-transparent">
		<nav class="flex items-center justify-between py-2 bg-transparent">
			<a
				wire:navigate
				href="/"
				class="flex items-center flex-shrink-0 mr-auto ml-auto text-white"
				aria-label="{{ config('app.name') }}"
			>
				<x-logo />
			</a>
{{--			<div>--}}
{{--				<x-ui.button--}}
{{--					size="xs"--}}
{{--					url="#how-to-play"--}}
{{--				>--}}
{{--					Modal example--}}
{{--				</x-ui.button>--}}
{{--			</div>--}}
		</nav>
	</x-container>
</header>
