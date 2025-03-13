<div class="w-full mt-60 mb-28 transition-opacity intersect:motion-opacity-in-0 motion-delay-200">
	<div class="grid grid-rows-1 place-items-center justify-center grid-flow-col auto-cols-max gap-4 mb-6 max-w-xs text-center text-gray-400 mx-auto">
		<x-ui.tag>{{ __('greetings.tags.minecraft') }}</x-ui.tag>
		<x-ui.tags-divider/>
		<x-ui.tag>{{ __('greetings.tags.vanilla') }}</x-ui.tag>
		<x-ui.tags-divider/>
		<x-ui.tag>{{ __('greetings.tags.server') }}</x-ui.tag>
	</div>
	<x-ui.heading
		size="6xl"
		color="white"
		fontStyle="bold"
		class="mb-8 text-center sm:max-w-md md:max-w-2xl lg:max-w-4xl mx-auto [text-shadow:_0_0px_4px_rgba(255,255,255,0.25)]"
	>
		{{ __('greetings.heading') }}
	</x-ui.heading>
	<div class="grid grid-rows-1 place-items-center justify-center grid-flow-col auto-cols-max gap-4 mb-4 max-w-xs text-center text-gray-400 mx-auto">
		<x-ui.status>
			<span class="text-gray-400 text-xs">{{ __('greetings.statuses.name') }}</span>
			<div class="inline-flex gap-2 justify-center items-center">
				@if($isOnline)
					<div class="size-2 inline-block rounded-[50%] bg-green-900 border border-green-500 shadow shadow-green-400"></div>
				@else
					<div class="size-2 inline-block rounded-[50%] bg-red-900 border border-red-500 shadow shadow-red-400"></div>
				@endif
				<span class="text-white text-sm">@if($isOnline) {{ __('greetings.statuses.active') }} @else {{ __('greetings.statuses.closed') }} @endif</span>
			</div>
		</x-ui.status>
		<x-ui.status>
			@php
				$color = $percentagePlayers <= 30 ? '#22c55e' : ($percentagePlayers <= 80 ? '#eab308' : '#ef4444')
			@endphp
			<span class="text-gray-400 text-xs">{{ __('greetings.statuses.online') }}</span>
			<div class="inline-flex gap-2 justify-center items-center">
				<svg class="drop-shadow-xl" style="--tw-drop-shadow: {{ $color }}; fill: {{ $color }}" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
					<g ><rect x="14" y="2" width="1" height="14"/></g>
					<g><rect x="11" y="5" width="1" height="11"/></g>
					<g><rect x="8" y="8" width="1" height="8"/></g>
					<g><rect x="5" y="11" width="1" height="5"/></g>
					<g><rect x="2" y="14" width="1" height="2"/></g>
				</svg>
				<span class="text-white text-sm">{{ $currentPlayers }} / {{ $availablePlayers }}</span>
			</div>
		</x-ui.status>
	</div>
</div>
