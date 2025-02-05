@props(['title', 'description' => '', 'description_href' => '', 'description_href_text' => ''])

<div class="flex flex-row flex-wrap">
  <div class="w-full md:w-1/3">
    <div class="px-4 md:px-0">
      <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</h3>
      <p class="mt-1 text-sm leading-5 text-gray-600">{{ $description }} <a class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150" href="{{ $description_href }}">{{ $description_href_text }}</a></p>
    </div>
  </div>
  {{ $slot }}
</div>
