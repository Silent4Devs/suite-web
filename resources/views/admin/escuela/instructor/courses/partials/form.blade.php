<div class="form-group">
    <div class="grid grid-cols-2 gap-4 mt-2 row justify-content-start">
        <div class="col-6">
            {{-- {!! Form::label('title', 'Título del curso',['class'=> 'mt-8 mb-2 font-bold']) !!} --}}
            <label class="required" for="title">Titulo del curso:</label>
            {!! Form::text('title', null, [
                'class' => 'form-control ' . ($errors->has('title') ? ' border-red-600' : ''),
            ]) !!}
            @error('title')
                <p class="text-danger">{{ $errors->first('title') }}</p>
            @enderror
        </div>
        <div class="col-6">
            <label class="required" for="slug">Slug del curso:</label>
            {!! Form::text('slug', null, [
                'class' => 'form-control' . ($errors->has('slug') ? ' border-red-600' : ''),
            ]) !!}
            @error('slug')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    {{-- <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
        aria-describedby="title" wire:model.defer="title" value="{{ old('title') }}" autocomplete="off">
        @if ($errors->has('title'))
        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
        @endif
        <span class="text-danger puesto_error error-ajax"></span> --}}

    {{-- {!! Form::label('subtitle', 'Subtítulo del curso:') !!} --}}
    <label class="required mt-3" for="subtitle">Subtítulo del curso:</label>
    {!! Form::text('subtitle', null, [
        'class' => 'form-control' . ($errors->has('subtitle') ? ' border-red-600' : ''),
    ]) !!}
    @error('subtitle')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    {{-- {!! Form::label('description', 'Descripción del curso:') !!} --}}
    <label class="required mt-3" for="description">Descripción del curso:</label>
    {!! Form::textarea('description', null, [
        'class' => 'form-control' . ($errors->has('description') ? ' border-red-600' : ''),
    ]) !!}
    @error('description')
        <p class="text-danger">{{ $message }}</p>
    @enderror

    <div class="mt-3 row justify-content-start">
        <div class="col-6">
            {{-- {!! Form::label('category_id', 'Categoría') !!} --}}
            <label class="required" for="category_id">Categoría</label>
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder'=>'Seleccione una opción']) !!}
            @error('category_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-6">
            {{-- {!! Form::label('level_id', 'Niveles') !!} --}}
            <label class="required" for="level_id">Niveles</label>
            {!! Form::select('level_id', $levels, null, ['class' => 'form-control', 'placeholder'=>'Seleccione una opción']) !!}
            @error('level_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        {{-- <div>
            {!! Form::label('price_id', 'Precio') !!}
            {!! Form::select('price_id', $prices, null, ['class' => 'form-control']) !!}
        </div> --}}
    </div>

    {{-- <h1 class="mt-8 mb-2 font-bold">Imagen del curso</h1> --}}
    {{-- {!! Form::label('imagen', 'Imagen del curso') !!} --}}
    <label class="required mt-3" for="image">Imagen del curso</label>
    <div class="row justify-content-start">
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
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

</div>
