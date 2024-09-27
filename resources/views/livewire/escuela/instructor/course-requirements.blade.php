<section class="mt-4">
    <h4>Requisitos del curso</h4>
    <hr class="mt-2 mb-6 bg-primary">

    @foreach ($course->requirements as $item)
        @if ($requirement->id == $item->id)
            <div class="registro rounded p-2">
                <form wire:submit='update'>
                    <input wire:model.live="formName" class="form-control">
                    @error('formName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </form>
            </div>
        @else
            <div class="registro py-2 pl-4 pr-4" style="border-radius:12px;">
                <div class="row justify-content-start">
                    <div class="col-9">
                        <p style="color:var(--color-tbj); margin:0px;">{{ $item->name }}</p>
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                        <i wire:click="edit({{ $item }})"
                            class="m-1 text-blue-500 cursor-pointer fas fa-edit"></i>
                        <i wire:click="destroy({{ $item }})" class="m-1 fa-regular fa-trash-can"></i>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <div class="card shadow-none">
        <div class="card-body" style="padding-bottom: 17px; padding-top:17px;">
            <form wire:submit="store" class="form-group mb-0">
                <div class="row justify-content-start align-items-baseline">
                    <div class="form-group col-9 pl-0 anima-focus mb-0">
                        <input wire:model.live="name" class="form-control" placeholder="">
                        <label for="name">Agregar el nombre del requisito*</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-light text-primary">Agregar <i
                                class="fa-solid fa-plus"></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>
