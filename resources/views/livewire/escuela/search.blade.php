<div>
    <form class="relative text-gray-600 mb-4 mt-4" autocomplete="off">
        <input wire:model.live.debounce.800ms="search" type="search" name="serch" placeholder="Buscar cursos"
            class="bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">

        <button type="submit"
            class="absolute right-0 top-0inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
            Buscar
        </button>

        @if ($search)
            <ul class="absolute z-50 left-0 w-full bg-white mt-1 rounded-lg over-flow-hidden">
                @forelse ($this->results as $result)
                    <li class="leading-10 px-5 text-sm cursos:pointer hover:bg-gray-300">
                        <a href="{{ route('courses.show', $result) }}">{{ $result->title }}</a>
                    </li>
                @empty
                    <li class="leading-10 px-5 text-sm cursos:pointer hover:bg-gray-300">
                        No hay ninguna coincidencia
                    </li>
                @endforelse
            </ul>
        @endif
    </form>
</div>
