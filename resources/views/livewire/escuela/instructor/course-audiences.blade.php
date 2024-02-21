<section class="mt-4">
    <h4>Audiencia del curso</h4>
    <hr class="mt-2 mb-6 bg-primary">

    @foreach ($course->audiences as $item)
        @if ($audience->id == $item->id)
            <div class="registro rounded p-2">
                <form wire:submit.prevent='update'>
                    <input wire:model.debounce.800ms="audience.name" class="form-control">
                    @error('audience.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </form>
            </div>
        @else
            <div class="registro rounded pt-2 pl-4 pr-4">
                <div class="row justify-content-start">
                    <div class="col-9">
                        <h4 style="color:#3086AF;">{{ $item->name }}</h4>
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                        <i wire:click="edit({{ $item }})"
                            class="m-1 text-blue-500 cursor-pointer fas fa-edit"></i>
                        <i wire:click="destroy({{ $item }})"class="m-1 fa-regular fa-trash-can"></i>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <article class="card shadow-none">
        <div class="card-body">
            <form wire:submit.prevent="store" class="form-group">
                <div class="grid grid-cols-2 gap-4 mt-2 row justify-content-start">
                    <div class="form-group col-9 pl-0 anima-focus">
                        {{-- {!! Form::label('title', 'Agregar el nombre del requisito*', [
                            'class' => 'pl-0',
                        ]) !!} --}}
                        <input wire:model.debounce.800ms="name" class="form-control" placeholder="">
                        <label for="name">Agregar el nombre del requisito*</label>
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-3 col-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-light text-primary">Agregar <i
                                class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </article>
</section>
