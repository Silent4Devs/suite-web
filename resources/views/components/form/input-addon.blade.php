@props(['disabled' => false, 'addon_text' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => "block w-full rounded-none rounded-l-md border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 sm:text-sm"]) !!}>
<span class="relative -ml-px inline-flex items-center space-x-2 rounded-r-md border border-gray-300 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-500">
  {{ $addon_text }}
</span>

