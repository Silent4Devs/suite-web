<div>
    <x-loading-indicator />
    <span for=""><strong>Nota: </strong>La importación de colaboradores genera el colaborador de acuerdo a su
        nombre que se indique en la columna "nombre" del archivo .xlsx, internamente se realizan dos procesos <strong>Si
            el nombre coincide con un nombre existente en la base de datos se actualiza el colaborador de lo contrario
            se procede a crear el registro y su usuario correspondiente.</strong></span>
    <br>
    <span>Es importante que si se actualiza el correo del colaborador se actualice manualmente su correspondiente en el
        modulo de usuarios <a href="{{ route('admin.users.index') }}"><i class="fas fa-share"></i></a></span>
    <br>
    <span for="">Los acentos en los cabezales son omitidos por temas de decodificación
        de
        la información</span>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Area</th>
                <th>Ingreso</th>
                <th>Nacimiento</th>
                <th>Correo</th>
                <th>Jefe</th>
                <th>Jerarquia</th>
                <th>Sexo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    John Doe Doe
                </td>
                <td>
                    Director General
                </td>
                <td>
                    Dirección General
                </td>
                <td>
                    01/01/2022
                </td>
                <td>
                    01/01/1997
                </td>
                <td>
                    example@mail.com
                </td>
                <td>
                    Jane Doe Doe
                </td>
                <td>
                    Nivel 1
                </td>
                <td>
                    Hombre
                </td>
            </tr>
        </tbody>
    </table>
    <div x-data="{ show: false }">
        <div style="text-align: end">
            <span class="mr-3"><i class="fas fa-info-circle"></i> Valores en las columnas</span>
            <i style="cursor: pointer" x-bind:class="show ? 'fas fa-minus' : 'fas fa-plus'" x-on:click="show=!show"></i>
        </div>
        <span x-show="show" x-transition>
            <strong>Nombre:</strong> Nombre(s) Apellido Paterno Apellido Materno
            <br>
            <strong>Puesto:</strong> Puesto del colaborador <strong>Se debe escribir tal cual está guardado el
                nombre en
                la
                herramienta, de lo contrario se necesita crear el puesto con lo escrito</strong>
            <a title="Ver lista de puestos" href="{{ route('admin.puestos.index') }}" target="_blank">
                <i class="fas fa-share"></i>
            </a>
            <br>
            <strong>Área:</strong> Área del colaborador <strong>Se debe escribir tal cual está guardado el nombre en
                la
                herramienta, de lo contrario se necesita crear el área con lo escrito</strong>
            <a title="Ver lista de áreas" href="{{ route('admin.areas.index') }}" target="_blank">
                <i class="fas fa-share"></i>
            </a>
            <br>
            <strong>Fecha de Ingreso:</strong> Fecha de ingreso en el formato <strong>dd/mm/YYYY</strong>
            <br>
            <strong>Fecha de Nacimiento:</strong> Fecha de nacimiento en el formato <strong>dd/mm/YYYY</strong>
            <br>
            <strong>Correo:</strong> Correo del colaborador
            <br>
            <strong>Jefe:</strong> Jefe inmediato del colaborador <strong>Se debe escribir tal cual está guardado el
                nombre en la
                herramienta, de lo contrario se necesita crear el colaborador con lo escrito</strong>
            <a title="Ver lista de colaboradores" href="{{ route('admin.empleados.index') }}" target="_blank">
                <i class="fas fa-share"></i>
            </a>
            <br>
            <strong>Jerarquía:</strong> Jerarquía del colaborador <strong>Se debe escribir tal cual está guardado
                el
                nombre en la
                herramienta, de lo contrario se necesita crear el Jerarquía con lo escrito</strong>
            <a title="Ver lista de jerarquías" href="{{ route('admin.perfiles.index') }}" target="_blank">
                <i class="fas fa-share"></i>
            </a>
            <br>
            <strong>Sexo:</strong> Definir cómo "H" o "M"
            <br>
        </span>
    </div>
    <br>
    <a style="text-decoration: none" href="{{ asset('imports/Empleados-Plantilla-Tabantaj.xlsx') }}" download="">
        <p style="font-size: 16px">Descargar Plantilla
            <i class="fas fa-download"></i>
        </p>
    </a>
    <br>
    <span for=""><strong>Nota: </strong>Los archivos aceptados son .xslx</span>
    <br>
    <span for=""><strong>Nota: </strong>En los errores de validación los números corresponen a la fila
        correspondiente en el archivo .xlsx</span>
    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">
        <!-- File Input -->
        <div class="custom-file" wire:ignore>
            <input type="file" class="custom-file-input" wire:model.live="file" id="file">
            <label class="custom-file-label" for="file">Selecciona un archivo de
                importación</label>
        </div>
        @error('file')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @error('*.*')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <!-- Progress Bar -->
        <div x-show="isUploading">
            <progress max="100" x-bind:value="progress"></progress>
        </div>
        <div>

            <a class="btn btn-success mt-4" href="{{ route('admin.empleados.index') }}">Regresar</a>
            <button class="btn btn-success mt-4" wire:click.prevent="import"><i
                    class="fas fa-file-excel mr-2"></i>Importar</button>
        </div>
    </div>
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("file").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    </script>
</div>
