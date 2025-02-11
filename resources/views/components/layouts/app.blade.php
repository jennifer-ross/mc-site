@php use Illuminate\Support\Facades\Request; @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	{{ seo()->render() }}

	@stack('head')
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	@livewireStyles
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins text-base leading-normal tracking-normal text-gray-800">
@php
	$style = '';

	if (Request::url() === '/') {
		$style = 'home';
	}
@endphp

@if($style === 'home')
	<div class="flex flex-col min-h-screen">
		<x-sections.header />

		<div class="flex flex-1 relative">
			{{ $slot }}
		</div>

		<x-sections.footer />
	</div>

@else
	<div class="flex flex-col min-h-screen bg-primary">
		<div class="bg-home-video max-h-[800px] h-[800px] absolute left-0 top-0 w-full">
			<video class="lazy absolute left-0 top-0 w-full h-full"
				   data-src="/api/video/background.mp4"
				   autoplay
				   muted
				   loop
				   preload="none"
				   disablepictureinpicture
				   disableremoteplayback
				   crossorigin="use-credentials"></video>
			<div class="bg-black bg-opacity-60 absolute left-0 top-0 w-full h-full">&nbsp;</div>
		</div>
		<x-sections.header />

		<div class="flex flex-1 relative">
			{{ $slot }}
		</div>

		<x-sections.footer />
	</div>

@endif

@livewireScriptConfig
@stack('scripts')
<script src="{{ asset('js/vendors/lazyload.min.js') }}"></script>
<script>
	window.modalsToInit = []
	document.addEventListener('DOMContentLoaded', e => {
		window.lazyLoadInstance = new LazyLoad({});
	})
</script>
<div class="modals left-0 top-0 z-50 w-full h-full">
	@stack('modals')
</div>
</body>
</html>
