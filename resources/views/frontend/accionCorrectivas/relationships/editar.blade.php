@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.accion-correctivas.create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Acción Correctiva </h3>
        </div>

        @include('layouts.errors')
        @include('flash::message')

        <div class="card-body">
            <div class="container">
                <div class="row">

                    <div class="mt-5 col-md-12">
                        <a class="btn btn-danger" data-toggle="collapse" onclick="closetabcollap1()" id="acollapseExample"
                            href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Acción Correctiva
                        </a>
                        <a class="btn btn-primary" data-toggle="collapse" onclick="closetabcollap2()" id="acollapseplan"
                            href="#collapseplan" role="button" aria-expanded="false" aria-controls="collapseplan">
                            Análisis de causa raíz
                        </a>
                        <a class="btn btn-primary show" data-toggle="collapse" onclick="closetabcollap3()"
                            id="acollapseactividad" href="#collapseactividad" role="button" aria-expanded="false"
                            aria-controls="collapseactividad">
                            Plan de acción
                        </a>
                        @if (empty($tab))
                            <div class="collapse show" id="collapseExample">
                                <div class="card card-body">
                                    <div id="test-nl-1" class="content">
                                        @include('admin.accionCorrectivas.editform1')

                                        <a class="btn btn-primary" onclick="closetabcollap1next()" id="nextcollapseForm1"
                                            role="button">
                                            Siguiente
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="collapse show" id="collapseExample">
                                <div class="card card-body">
                                    <div id="test-nl-1" class="content">
                                        @include('admin.accionCorrectivas.editform1')

                                        <a class="btn btn-primary" onclick="closetabcollap1next()" id="nextcollapseForm1"
                                            role="button">
                                            Siguiente
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="collapse" id="collapseplan">
                            <div class="card card-body">
                                @include('admin.accionCorrectivas.editform2')
                            </div>
                        </div>
                        @if (empty($tab))
                            <div class="collapse" id="collapseactividad">
                                <div class="card card-body">
                                    @include('admin.accionCorrectivas.edit_planaccion')
                                </div>
                            @else
                                <div class="collapse show" id="collapseactividad">
                                    <div class="card card-body">
                                        @include('admin.accionCorrectivas.edit_planaccion')
                                    </div>
                                </div>
                        @endif
                    </div>
                </div>


            </div>
        </div>


    </div>

@endsection


@section('scripts')
    <script>
        $("#acollapseExample").click(function() {

            $("#acollapseExample").removeClass('btn btn-primary').addClass("btn btn-danger");
            $("#acollapseplan").removeClass('btn btn-danger').addClass("btn btn-primary");
            $("#acollapseactividad").removeClass('btn-danger').addClass("btn-primary");
        });

        $("#acollapseplan").click(function() {
            $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
            $(this).toggleClass("btn btn-danger");
            $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
            $("#acollapseactividad").removeClass('btn-danger').addClass("btn-primary");
        });
        $("#nextcollapseForm1").click(function() {
            $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
            $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
            $("#acollapseactividad").removeClass('btn-danger').addClass("btn-primary");

        });

        $("#acollapseactividad").click(function() {
            $("#acollapseExample").removeClass('btn-danger').addClass("btn-primary");
            $("#acollapseplan").removeClass('btn-danger').addClass("btn-primary");
            $("#acollapseactividad").removeClass('btn-primary').addClass("btn-danger");
        });



        function closetabcollap1() {
            $('#collapseExample').collapse('show');
            $('#collapseplan').collapse('hide');
            $('#collapseactividad').collapse('hide');
        }

        function closetabcollap1next() {
            $('#collapseExample').collapse('hide');
            $('#collapseplan').collapse('show');
            $('#collapseactividad').collapse('hide');
        }

        function closetabcollap2() {
            $('#collapseExample').collapse('hide');
            $('#collapseplan').collapse('show');
            $('#collapseactividad').collapse('hide');
        }

        function closetabcollap3() {
            $('#collapseExample').collapse('hide');
            $('#collapseplan').collapse('hide');
            $('#collapseactividad').collapse('show');
        }

    </script>
    <script>
        var uploadedDocumentomeToDoMap = {}
        Dropzone.options.documentometodoDropzone = {
            url: "{{ route('admin.accion-correctivas.storeMedia') }}",
            maxFilesize: 4, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="documentometodo[]" value="' + response.name + '">')
                uploadedDocumentomeToDoMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentomeToDoMap[file.name]
                }
                $('form').find('input[name="documentometodo[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($accionCorrectiva) && $accionCorrectiva->documentometodo)
                    var files =
                    {!! json_encode($accionCorrectiva->documentometodo) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="documentometodo[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

    </script>
@endsection
