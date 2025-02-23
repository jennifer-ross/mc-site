@props([
	'url' => null,
	'user' => null,
	'message' => null,
])

@if($url && $user && $user->hasVerification())
	<x-ui.button
		:url="$url"
		wire:navigate
		class="bg-transparent text-primary hover:bg-primary-100 hover:text-white max-w-xs w-full relative flex-shrink rounded-2xl"
	>
		<div class="flex gap-3 w-full justify-between py-1">
			<div class="flex gap-3">
				<div class="relative">
					<x-img
						class="size-10"
						:media=1
						format="webp"
						quality="80"
						alt="{{ $user->name }}"
					/>
				</div>
				<div class="flex flex-col gap-1">
					<span class="font-bold">{{ $user->name }}</span>
					<span class="text-xs">
						{{ !$message->is_deleted ? $message->getExcerptAttribute() : __('message.deleted') }}
						@if($message->is_edited)
							<small class="lowercase italic text-gray-400">({{ __('message.edited') }})</small>
						@endif
					</span>
				</div>
			</div>
			<time
				x-tooltip.raw="{{ $message->created_at->format('F j, Y') }}"
				datetime="{{ $message->created_at->format('Y-m-d H:i:s') }}"
				class="text-gray-400 self-start"
			>
				{{
//	$message->created_at->diffForHumans()
					$message->created_at->format('H:i')
				}}
			</time>
		</div>
	</x-ui.button>
@endif

