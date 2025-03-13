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
	@vite('resources/css/app.css')
</head>

<body class="font-poppins text-base leading-normal tracking-normal text-gray-800 scroll-primary">
@php
	$style = 'none';

	if (Request::fullUrl() === config('app.url')) {
		$style = 'home';
	}
@endphp

{{--@if($style !== 'home')--}}
@if(Auth::check())
	<div class="flex flex-col min-h-screen bg-primary-600">
		<x-sections.header />

		<main class="flex flex-1 relative">
			<x-sidebars.left/>
			{{ $slot }}
		</main>

		<x-sections.footer />
	</div>
@else
	<div class="flex flex-col min-h-screen bg-primary-900">
		<x-bg-video/>
		<x-sections.header />

		<div class="flex flex-1 relative style-{{ $style }}">
			<main class="flex flex-1 z-10">
				{{ $slot }}
			</main>
		</div>

		<x-sections.footer />
	</div>
@endif

@livewireScriptConfig
<x-scripts/>
<div class="modals left-0 top-0 z-50 w-full h-full">
	@stack('modals')
</div>
</body>
</html>
