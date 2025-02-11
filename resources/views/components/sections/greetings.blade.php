<div class="w-full mt-40">
	<div class="grid grid-rows-1 place-items-center justify-center grid-flow-col auto-cols-max gap-4 mb-4 max-w-xs text-center text-gray-400 mx-auto">
		<x-ui.tag>{{ __('greetings.tags.minecraft') }}</x-ui.tag>
		<x-ui.tags-divider/>
		<x-ui.tag>{{ __('greetings.tags.vanilla') }}</x-ui.tag>
		<x-ui.tags-divider/>
		<x-ui.tag>{{ __('greetings.tags.server') }}</x-ui.tag>
	</div>
	<h1 class="mb-6 text-6xl font-bold text-white text-center sm:max-w-md md:max-w-2xl lg:max-w-4xl mx-auto">
		{{ __('greetings.heading') }}
	</h1>
	<div class="grid grid-rows-1 place-items-center justify-center grid-flow-col auto-cols-max gap-4 mb-4 max-w-xs text-center text-gray-400 mx-auto">
		<x-ui.status>
			<span class="text-gray-400 text-xs">{{ __('greetings.statuses.name') }}</span>
			<div class="inline-flex gap-2 justify-center items-center">
				@if(true)
					<div class="size-2 inline-block rounded-[50%] bg-green-900 border border-green-500 shadow shadow-green-400"></div>
				@else
					<div class="size-2 inline-block rounded-[50%] bg-red-900 border border-red-500 shadow shadow-red-400"></div>
				@endif
				<span class="text-white text-sm">{{ __('greetings.statuses.active') }}</span>
			</div>
		</x-ui.status>
		<x-ui.status>
			<span class="text-gray-400 text-xs">{{ __('greetings.statuses.online') }}</span>
			<div class="inline-flex gap-2 justify-center items-center">
				<svg class="fill-green-500 drop-shadow-xl" style="--tw-drop-shadow: #22c55e" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
					<g ><rect x="14" y="2" width="1" height="14"/></g>
					<g><rect x="11" y="5" width="1" height="11"/></g>
					<g><rect x="8" y="8" width="1" height="8"/></g>
					<g><rect x="5" y="11" width="1" height="5"/></g>
					<g><rect x="2" y="14" width="1" height="2"/></g>
				</svg>
				<span class="text-white text-sm">36 / 40</span>
			</div>
		</x-ui.status>
	</div>
</div>
