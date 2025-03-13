@props([
	'chat'
])

<div class="flex-1 flex flex-col gap-8 justify-center items-center w-full" x-data="{
	init: function() {

	}
}">
	<div class="w-full flex flex-col gap-4 justify-center items-center h-full">
		<x-chat.head :chat="$chat"/>
		<x-chat.content :chat="$chat"/>
	</div>
	<div class="message-box min-w-64 w-full max-h-32 max-w-xl mb-8 flex relative" id="message-box">
		<div id="editor" class="w-full bg-primary-100 rounded-xl py-4 pl-4 pr-10 font-normal text-base text-white"></div>
		<x-ui.button class="h-full absolute text-white right-0 top-1/2 -translate-y-1/2 rounded-xl [&]:hover:bg-transparent">
			<x-icon name="bx-send" class="size-5" />
		</x-ui.button>
	</div>
</div>
