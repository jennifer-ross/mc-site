@props([
	'level' => '1',
	'size' => 'sm',
	'color' => 'white',
	'fontStyle' => '',
	'class' => '',
])

@php($level = match ($level) {
  '1' => '1',
  '2' => '2',
  '3' => '3',
  '4' => '4',
  '5' => '5',
  default => '1',
})

@php($size = match ($size) {
  'xs' => 'text-xs',
  'sm' => 'text-sm',
  'md' => 'text-base',
  'lg' => 'text-lg',
  'xl' => 'text-xl',
  '2xl' => 'text-2xl',
  '3xl' => 'text-3xl',
  '6xl' => 'text-6xl',
  default => 'text-base',
})

@php($color = match ($color) {
  'primary' => 'text-primary-300',
  'white' => 'text-white',
  'gray' => 'text-gray-400',
  default => 'text-white',
})

@php($fontStyle = match ($fontStyle) {
  'bold' => 'font-bold',
  'ebold' => 'font-extrabold',
  'sbold' => 'font-semibold',
  'light' => 'font-light',
  'elight' => 'font-extralight',
  'thin' => 'font-thin',
  'medium' => 'font-medium',
  default => '',
})

<h{{$level}}
	{{ $attributes->merge(['class' => "{$fontStyle} {$size} {$color} {$class}"]) }}
>
	{{ $slot }}
</h{{$level}}>
