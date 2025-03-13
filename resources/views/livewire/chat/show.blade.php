<x-container.content>
	@if(Auth::check())
		@push('scripts')
			@vite('resources/css/quill.snow.css')
			@vite('resources/css/quill.mention.min.css')
			@vite('resources/js/modules/echo.js')
			@vite('resources/js/modules/chat.js')
		@endpush
		<div class="flex flex-1 w-full relative max-w-8xl mx-auto m-14 shadow-3lg rounded-xl bg-primary-500">
			<x-chat.list :chats="$chats"/>
			<x-chat.body :chat="$currentChat"/>
		</div>
	@endif
</x-container.content>
