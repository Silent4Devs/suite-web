<section>
    <h1 class="text-2xl font-bold">Metas del curso</h1>
    <hr class="mt-2 mb-6">

    @foreach ($course->goals as $item)
        <article class="mb-4 card">
            <div class="bg-gray-100 card-body">
                @if ($goal->id == $item->id)
                    <form wire:submit.prevent='update'>
                        <input wire:model="goal.name" class="w-full form-input">
                        @error('goal.name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </form>
                @else
                    <header class="flex justify-between">
                        <h1>{{ $item->name }}</h1>
                        <div class="flex-shrink-0 select-none">
                            <i wire:click="edit({{ $item }})"
                                class="text-blue-500 cursor-pointer fas fa-edit"></i>
                            <i wire:click="destroy({{ $item }})"
                                class="text-red-500 cursor-pointer fas fa-trash"></i>
                        </div>
                    </header>
                @endif
            </div>
        </article>
    @endforeach

    <article class="card">
        <div class="bg-gray-100 card-body">
            <form wire:submit.prevent="store">
                <input wire:model="name" class="w-full form-input" placeholder="Agregar el nombre de la meta">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="flex justify-end mt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">Agregar meta</button>
                </div>
            </form>
        </div>
    </article>
</section>
