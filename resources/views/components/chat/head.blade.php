@props([
	'chat'
])

@php
	$time = new \Illuminate\Support\Carbon($chat->owner->last_interaction);
	$online = (new \Illuminate\Support\Carbon($time->unix()))->addMinutes(5) >= now();
@endphp

<div class="flex p-4 w-full text-white">
	<div class="flex gap-3">
		<div class="relative flex">
			<x-img
				class="size-10"
				:media=1
				format="webp"
				quality="80"
				alt="{{ $chat->owner->name }}"
			/>
		</div>
		<div class="flex flex-col">
			<span class="font-bold">{{ $chat->owner->name }}</span>
			@if($chat->isPrivate)
				<time
					datetime="{{ $time->format('Y-m-d H:i:s') }}"
					class="text-gray-400 self-start text-sm -mt-0.5"
				>
					{{ $online ? 'Online' : $time->diffForHumans() }}
				</time>
			@endif
		</div>
	</div>
</div>
