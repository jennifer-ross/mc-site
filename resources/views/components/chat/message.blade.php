@props([
	'userName',
	'is_deleted',
	'is_edited',
	'text',
	'created_at',
	'class' => '',
])

@php
	$created_at = new \Illuminate\Support\Carbon($created_at);
@endphp

<div {{ $attributes->merge(['class' => "flex gap-3 w-full justify-between py-1 transition duration-400 ease {$class}"]) }}>
	<div class="flex gap-3">
		<div class="relative">
			<x-img
				class="size-10"
				:media=1
				format="webp"
				quality="80"
				alt="{{ $userName }}"
			/>
		</div>
		<div class="flex flex-col gap-1">
			<span class="font-bold">{{ $userName }}</span>
			<span class="text-xs">
				{{ !$is_deleted ? $text : __('message.deleted') }}
				@if($is_edited)
					<small class="lowercase italic text-gray-400">({{ __('message.edited') }})</small>
				@endif
			</span>
		</div>
	</div>
	<time
		x-tooltip.raw="{{ $created_at->format('F j, Y') }}"
		datetime="{{ $created_at->format('Y-m-d H:i:s') }}"
		class="text-gray-400 self-start"
	>
		{{
//	$message->created_at->diffForHumans()
			$created_at->format('H:i')
		}}
	</time>
</div>
