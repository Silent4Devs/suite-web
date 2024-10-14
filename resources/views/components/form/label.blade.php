@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700 leading-5']) }}>
  {{ $value ?? $slot }}
</label>
