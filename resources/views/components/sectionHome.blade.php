@props([
	'title' => null,
	'description' => null,
	'position' => 'right',
	'image' => null,
])

@php($isCenter = $position === 'center')

@php($position = match ($position) {
  'left' => 'order-2 ml-10',
  'right' => 'order-1 mr-40',
  'center' => 'mx-auto',
  default => 'order-1 mr-40',
})

{{--intersect-once--}}
<div class="flex justify-between mx-auto w-full my-20 px-4 sm:max-w-md sm:px-0 md:max-w-2xl lg:max-w-4xl xl:max-w-6xl transition-opacity intersect:motion-translate-y-in-75 intersect:motion-opacity-in-0 motion-delay-200">
	<div class="flex flex-col gap-4 w-full {{ $position }}">
		@if($title)
			<x-ui.heading
				class="{{ $isCenter ? 'text-center' : '' }}"
				level="2"
				size="3xl"
				fontStyle="bold"
			>
				{{ $title }}
			</x-ui.heading>
		@endif
		@if($description)
			<p class="max-w-2xl text-gray-300 font-light tracking-wide break-words {{ $isCenter ? "{$position} text-center" : '' }}">
				{{ $description }}
			</p>
		@endif
		{{ $slot }}
	</div>
	@if($image)
		<div class="flex order-1">
			<x-img
				:media=$image
				format="webp"
				quality="80"
				:srcset="['1200w', '480w', '320w']"
				sizes="(max-width: 1200px) 100vw, 40vw"
				alt="{{ config('app.name') }}"
			/>
		</div>
	@endif
</div>
