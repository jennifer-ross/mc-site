<div class="flex flex-1 w-full flex-col">
	@if(!Auth::check())
		<x-greetings/>
		<x-sections.stability/>
		<x-sections.projects/>
		<x-sections.what-is/>
		<x-sections.events/>
		<x-sections.how-to-play/>
		<x-sections.subscribe/>

		@push('modals')
			<x-modals.auth/>
		@endpush
	@else
		<div class="flex flex-1 w-full">
			<div>

			</div>
		</div>
	@endif
</div>
