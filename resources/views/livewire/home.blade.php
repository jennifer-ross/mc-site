<div class="flex flex-1 w-full flex-col">
	<x-sections.greetings/>
	<x-sections.what-is/>
	<x-sections.how-to-play/>
	<x-sections.subscribe/>

	@push('modals')
		<x-modals.auth/>
	@endpush
</div>
