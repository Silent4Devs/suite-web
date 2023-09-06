<div class="form-group">
    <div class="grid grid-cols-2 gap-4 mt-2 row justify-content-start">
        <div class="col-6">
            {!! Form::label('title', 'Título del curso',['class'=> 'mt-8 mb-2 font-bold']) !!}
            {!! Form::text('title', null, [
                'class' => 'form-control' . ($errors->has('title') ? ' border-red-600' : ''),
            ]) !!}
            @error('title')
                <p class="text-sm text-red-500">{{ $errors->first('title') }}</p>
            @enderror
        </div>
        <div class="col-6">
            {!! Form::label('slug', 'Slug del curso:') !!}
            {!! Form::text('slug', null, [
                'class' => 'form-control' . ($errors->has('slug') ? ' border-red-600' : ''),
            ]) !!}
            @error('slug')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>
    {{-- <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
        aria-describedby="title" wire:model.defer="title" value="{{ old('title') }}" autocomplete="off">
        @if ($errors->has('title'))
        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
        @endif
        <span class="text-danger puesto_error error-ajax"></span> --}}

    {!! Form::label('subtitle', 'Subtítulo del curso:') !!}
    {!! Form::text('subtitle', null, [
        'class' => 'form-control' . ($errors->has('subtitle') ? ' border-red-600' : ''),
    ]) !!}
    @error('subtitle')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
    {!! Form::label('description', 'Descripción del curso:') !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control' . ($errors->has('description') ? ' border-red-600' : ''),
    ]) !!}
    @error('description')
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror

    <div class="grid grid-cols-2 gap-4 mt-2 row justify-content-start">
        <div class="col-6">
            {!! Form::label('category_id', 'Categoría') !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder'=>'Seleccione una opción']) !!}
            @error('category_id')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-6">
            {!! Form::label('level_id', 'Niveles') !!}
            {!! Form::select('level_id', $levels, null, ['class' => 'form-control', 'placeholder'=>'Seleccione una opción']) !!}
            @error('level_id')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        {{-- <div>
            {!! Form::label('price_id', 'Precio') !!}
            {!! Form::select('price_id', $prices, null, ['class' => 'form-control']) !!}
        </div> --}}
    </div>

    {{-- <h1 class="mt-8 mb-2 font-bold">Imagen del curso</h1> --}}
    {!! Form::label('imagen', 'Imagen del curso') !!}
    <div class="grid grid-cols-2 gap-4 row justify-content-start">
        <div class="col-6">
            <figure class="object-fit: container; width: 250px;height: 100px; background:green;">
                @isset($course->image->url)
                    <img  src="{{ Storage::url($course->image->url) }}"
                        id="picture" alt="" style="height:100px">
                @else
                <img class="object-cover object-center w-full h-64" src="{{ asset('img/escuela/home/imagen-estudiantes.jpg') }}" id="picture"
                alt="" style="width: 200px;height: 200px;">
                @endisset
            </figure>
        </div>
        <div class="col-6">
            {{-- @isset($course)
                <p class="mb-4">{{ $course->description }}</p>
            @endisset --}}
            {!! Form::file('file', [
                'class' => 'form-input w-full' . ($errors->has('file') ? ' border-red-600' : ''),
                'id' => 'file',
                'accept' => 'image/*',
            ]) !!}
            @error('file')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

</div>
