@if(Auth::check())
	<x-sections.header.main/>
@else
    <x-sections.header.fixed/>
@endif
