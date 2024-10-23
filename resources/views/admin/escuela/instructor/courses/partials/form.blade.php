<div class="form-group">
    <div class="mt-2 row justify-content-start">
        <div class="form-group col-6 anima-focus">
            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'border-red-600' : '' }}" placeholder="" value="{{ old('title', $course->title) }}">
            <label for="title">Título del curso*:</label>
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-6 anima-focus">
            <input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? 'border-red-600' : '' }}" placeholder="" value="{{ old('slug', $course->slug) }}">
            <label for="slug">Slug del curso*:</label>
            @error('slug')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-12 anima-focus">
            <input type="text" name="subtitle" class="form-control {{ $errors->has('subtitle') ? 'border-red-600' : '' }}" placeholder="" value="{{ old('subtitle', $course->subtitle) }}">
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
            <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'border-red-600' : '' }}" placeholder="">{{ old('description', $course->description) }}</textarea>
            <label for="description">Descripción del curso:</label>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

    </div>
    {{-- <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title"
        aria-describedby="title" wire:model="title" value="{{ old('title') }}" autocomplete="off">
        @if ($errors->has('title'))
        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
        @endif
        <span class="text-danger puesto_error error-ajax"></span> --}}

    {{-- {!! Form::label('subtitle', 'Subtítulo del curso:') !!} --}}
    {{-- {!! Form::label('description', 'Descripción del curso:') !!} --}}


    <div class="mt-3 row justify-content-start">
        <div class="form-group col-6 anima-focus">
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Seleccione una opción</option>
                @foreach($categories as $key => $value)
                    <option value="{{ $key }}" {{ old('category_id', $selectedCategory) == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            <label for="category_id">Categoría*</label>
            @error('category_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-6 anima-focus">
            <select name="level_id" id="level_id" class="form-control">
                <option value="">Seleccione una opción</option>
                @foreach($levels as $key => $value)
                    <option value="{{ $key }}" {{ old('level_id', $selectedLevel) == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            <label for="level_id">Niveles*</label>
            @error('level_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
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
            <input type="file" name="file"
                   class="form-input w-full {{ $errors->has('file') ? 'border-red-600' : '' }}"
                   id="file"
                   accept="image/*">
            @error('file')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

    </div>

</div>
