<section class="mt-4">
    <h1 class="text-2xl font-bold">Audiencia del curso</h1>
    <hr class="mt-2 mb-6">

    @foreach ($course->audiences as $item)
        <article class="mb-4 card">
            <div class="bg-gray-100 card-body">
                @if ($audience->id == $item->id)
                    <form wire:submit.prevent='update'>
                        <input wire:model="audience.name" class="w-full form-input">
                        @error('audience.name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </form>
                @else
                    <header class="flex justify-between">
                        <h1>{{ $item->name }}</h1>
                        <div>
                            <i wire:click="edit({{ $item }})"
                                class="text-blue-500 cursor-pointer fas fa-edit"></i>
                            <i wire:click="destroy({{ $item }})"
                                class="ml-2 text-red-500 cursor-pointer fas fa-trash"></i>
                        </div>
                    </header>
                @endif
            </div>
        </article>
    @endforeach

    <article class="card">
        <div class="bg-gray-100 card-body">
            <form wire:submit.prevent="store">
                <input wire:model="name" class="w-full form-input" placeholder="Agregar la audiencia del curso">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="flex justify-end mt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">Agregar audiencia</button>
                </div>
            </form>
        </div>
    </article>
</section>
