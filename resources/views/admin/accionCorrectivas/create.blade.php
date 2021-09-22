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
                        <button id="acollapseExample" data-toggle="collapse" onclick="closetabcollap1()"
                            data-target="#collapseExample" class="btn btn_cancelar btn-danger">Acción Correctiva</button>
                        <button id="acollapseplan" data-toggle="collapse" onclick="closetabcollap2()"
                            data-target="#collapseplan" class="btn btn_cancelar" style="width: 200px !important;">Análisis de causa raíz</button>
                        <button id="acollapseactividad" data-toggle="collapse" onclick="" data-target="#"
                            class="btn btn_cancelar">Plan de acción</button>

                        <div class="collapse show mt-3" id="collapseExample">
                            <div class="card card-body">
                                <div id="test-nl-1" class="content">
                                    @include('admin.accionCorrectivas.createform1')

                                </div>
                            </div>
                        </div>
                        <div class="collapse mt-3" id="collapseplan">
                            <div class="card card-body">
                                @include('admin.accionCorrectivas.createform2')
                            </div>
                        </div>
                        <div class="collapse mt-3" id="collapseactividad">
                            <div class="card card-body">




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
                });

                $("#acollapseplan").click(function() {
                    $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
                    $(this).toggleClass("btn btn-danger");
                    $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
                });
                $("#form-siguienteaccion").click(function() {
                    $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
                    $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
                });



                function closetabcollap1() {
                    $('#collapseExample').collapse('show');
                    $('#collapseplan').collapse('hide');
                    $('#collapseactividad').collapse('hide');
                }



                function closetabcollap2() {
                    $('#collapseExample').collapse('hide');
                    $('#collapseplan').collapse('show');
                    $('#collapseactividad').collapse('hide');
                }

                function closetabcollanext2() {
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
                        $('form').find('input[name="documentometodo"]').remove()
                        $('form').append('<input type="hidden" name="documentometodo" value="' + response.name +
                            '">')
                    },
                    removedfile: function(file) {
                        file.previewElement.remove()
                        if (file.status !== 'error') {
                            $('form').find('input[name="documentometodo"]').remove()
                            this.options.maxFiles = this.options.maxFiles + 1
                        }
                    },
                    init: function() {
                        @if (isset($accionCorrectiva) && $accionCorrectiva->documentometodo)
                            var file = {!! json_encode($accionCorrectiva->documentometodo) !!}
                            this.options.addedfile.call(this, file)
                            file.previewElement.classList.add('dz-complete')
                            $('form').append('<input type="hidden" name="documentometodo" value="' + file.file_name + '">')
                            this.options.maxFiles = this.options.maxFiles - 1
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
