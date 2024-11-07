@props(['variant' => 'primary'])
@php
  $variantClass = [
      'primary' => 'bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5',
      'secondary' => 'bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5',
      'success' => 'bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5',
      'danger' => 'bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5',
      'warning' => 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5',
  ][$variant];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full {$variantClass}"]) }}>{{ $slot ?? '' }}</span>
