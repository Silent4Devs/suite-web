<div class="form-group">
    <div class="mt-2 row justify-content-start">
        <div class="form-group col-6 anima-focus">
            {{-- {!! Form::label('title', 'Título del curso',['class'=> 'mt-8 mb-2 font-bold']) !!} --}}
            {!! Form::text('title', null, [
                'class' => 'form-control ' . ($errors->has('title') ? ' border-red-600' : ''),
                'placeholder' => '',
            ]) !!}
            <label for="title">Titulo del curso*:</label>
            @error('title')
                <p class="text-danger">{{ $errors->first('title') }}</p>
            @enderror
        </div>
        <div class="form-group col-6 anima-focus">
            {!! Form::text('slug', null, [
                'class' => 'form-control' . ($errors->has('slug') ? ' border-red-600' : ''),
                'placeholder' => '',
            ]) !!}
            <label for="slug">Slug del curso*:</label>
            @error('slug')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-12 anima-focus">
            {!! Form::text('subtitle', null, [
                'class' => 'form-control' . ($errors->has('subtitle') ? ' border-red-600' : ''),
                'placeholder' => '',
            ]) !!}
            <label class="required mt-3" for="subtitle">Subtítulo del curso:</label>
            @error('subtitle')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-12 anima-focus">
            <select name="empleado_id" class="form-control{{ $errors->has('empleado_id') ? ' border-red-600' : '' }}">
                <option value="" disabled></option>
                @foreach ($empleados as $empleado)
                    @if ($empleado->empleado)
                        @if ($empleado->empleado->estatus == 'alta')
                            <option value="{{ $empleado->id }}"
                                {{ isset($course) && $empleado->id == $course->empleado_id ? 'selected' : '' }}>
                                {{ $empleado->name }}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
            <label class="required mt-3" for="empleado_id">Instructor del curso:</label>
            @error('empleado_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-12 anima-focus">
            {!! Form::textarea('description', null, [
                'class' => 'form-control' . ($errors->has('description') ? ' border-red-600' : ''),
                'placeholder' => '',
            ]) !!}
            <label for="description">Descripción del curso:</label>
            @error('description')
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
    {{-- {!! Form::label('description', 'Descripción del curso:') !!} --}}


    <div class="mt-3 row justify-content-start">
        <div class="form-group col-6 anima-focus">
            {{-- {!! Form::label('category_id', 'Categoría') !!} --}}
            {!! Form::select('category_id', $categories, null, [
                'class' => 'form-control',
                'placeholder' => 'Seleccione una opción',
            ]) !!}
            <label for="category_id">Categoría*</label>
            @error('category_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-6 anima-focus">
            {{-- {!! Form::label('level_id', 'Niveles') !!} --}}
            {!! Form::select('level_id', $levels, null, [
                'class' => 'form-control',
                'placeholder' => 'Seleccione una opción',
            ]) !!}
            <label for="level_id">Niveles*</label>
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
                    <img src="{{ asset($course->image->url) }}" id="picture" alt="" style="height:100px">
                @else
                    <img class="object-cover object-center w-full h-64"
                        src="{{ asset('img/escuela/home/imagen-estudiantes.jpg') }}" id="picture" alt=""
                        style="width: 200px;height: 200px;">
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
