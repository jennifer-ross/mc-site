<div class="flex flex-1 w-full flex-col relative">
	@if(Auth::check())
		<div class="flex flex-1 w-full">
			<div class="flex flex-col p-4 gap-2">
				@foreach ($chats as $chat)
					<x-chat.tiny
						url="/chat/{{ $chat['chat']->id }}"
						:user="$chat['message']?->sender"
						:message="$chat['message']"
					/>
				@endforeach
			</div>
			<div class="flex-1 flex justify-center items-center">
				Full chat content
			</div>
		</div>
	@endif
</div>
