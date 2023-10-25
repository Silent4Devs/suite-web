@extends('layouts.admin')

<head> <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

@section('content')
    <h5 class="titulo">Construir Evaluación para medir el cumplimiento del Análisis de Brechas</h5>

    <div class="card card-t">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}"
                    style="margin: 9px 10px 10px 10px; width: 128px; height: 119px;">
            </div>
            <div class="col-md-10">
                <div class="pt-2">
                    <p class="letra-titulo-template mt-2">Crea tu template</p>
                    <p class="letra-subtitulo-template mb-2">Genera tus preguntas y personaliza tus campos según lo
                        requieras
                    </p>
                    <p class="letra-subtitulo-template mb-2">Elaboraremos nuestro cuestionario que nos permitirá evaluar el
                        cumplimiento de nuestra norma seleccionada.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-body mt-5">
        <div style="color:#306BA9; font-size:16px;">Datos Generales</div>
        <hr style="">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3 ">
                        <input type="text" class="form-control" placeholder="Nombre del Template" id="nombre_template"
                            name="nombre_template" required>
                        <label for="nombre_template">Nombre del Template</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 ">
                        <select id="norma" name="norma" class="form-control " required>
                            @foreach ($normas as $norma)
                                <option value="{{ $norma->id }}">{{ $norma->norma }}</option>
                            @endforeach
                        </select>
                        <label for="norma">Norma</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion"></textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card card-body mt-5">
        <div class="col-m-12" style="color:#306BA9; font-size:16px;">
            Define el valor de los parámetros con los que se evaluará tu cuestionario
        </div>
        <div class="col-m-12 mt-3" style="font: italic 14px Roboto;">
            Estatus: Define el nombre de tu parámetro
        </div>
        <div class="col-m-12 mt-3" style="font: italic 14px Roboto;">
            Valor: Agrega el valor de tu parámetro con los que se evaluará tu cuestionario
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <div class="form-row">
                    <div class="col-8">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_1" name="estatus_1" class="form-control" placeholder="Estatus"
                                required>
                            <label for="estatus_1">Estatus</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_1" name="valor_estatus_1" class="form-control"
                                placeholder="Valor" required>
                            <label for="valor_estatus_1">Valor</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 color-picker">
                        <input type="color" id="color_estatus_1" name="color_estatus_1" class="color-input form-control"
                            value="#563d7c" title="Seleccione un color">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-row">
                    <div class="col-8">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_2" name="estatus_2" class="form-control" placeholder="Estatus"
                                required>
                            <label for="estatus_2">Estatus</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_2" name="valor_estatus_2" class="form-control"
                                placeholder="Valor" required>
                            <label for="valor_estatus_2">Valor</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 color-picker">
                        <input type="color" id="color_estatus_2" name="color_estatus_2"
                            class="color-input form-control" value="#563d7c" title="Seleccione un color">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-row">
                    <div class="col-8">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_3" name="estatus_3" class="form-control"
                                placeholder="Estatus">
                            <label for="estatus_3">Estatus</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_3" name="valor_estatus_3" class="form-control"
                                placeholder="Valor">
                            <label for="valor_estatus_3">Valor</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 color-picker">
                        <input type="color" id="color_estatus_3" name="color_estatus_3"
                            class="color-input form-control" value="#563d7c" title="Seleccione un color">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-row">
                    <div class="col-8">
                        <div class="form-floating mb-3 ">
                            <input type="text" id="estatus_4" name="estatus_4" class="form-control"
                                placeholder="Estatus">
                            <label for="estatus_4">Estatus</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3 ">
                            <input type="number" id="valor_estatus_4" name="valor_estatus_4" class="form-control"
                                placeholder="Valor">
                            <label for="valor_estatus_4">Valor</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 color-picker">
                        <input type="color" id="color_estatus_4" name="color_estatus_4"
                            class="color-input form-control" value="#563d7c" title="Seleccione un color">
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Aqui se necesita el livewire --}}

    @livewire('secciones-template')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
