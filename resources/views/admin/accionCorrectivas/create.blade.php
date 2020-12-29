@extends('layouts.admin')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">


<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Acción Correctiva </h3>
    </div>
    @include('layouts.errors')
    @include('flash::message')
    <div class="card-body">

        <div class="container">
            <div class="row">

                <div class="col-md-12 mt-5">
                <button id="acollapseExample" data-toggle="collapse" onclick="closetabcollap1()" data-target="#collapseExample" class="btn btn-danger">Acción Correctiva</button>
                <button id="acollapseplan" data-toggle="collapse" onclick="closetabcollap2()" data-target="#collapseplan" class="btn btn-primary">Análisis de causa raíz</button>
                <button id="acollapseactividad" data-toggle="collapse" onclick="" data-target="#" class="btn btn-primary">Plan de acción</button>
           
                    </p>
                    <div class="collapse show" id="collapseExample">
                        <div class="card card-body">
                            <div id="test-nl-1" class="content">
                            @include('admin.accionCorrectivas.createform1')

                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseplan">
                        <div class="card card-body">
                        @include('admin.accionCorrectivas.createform2')
                        </div>
                    </div>
                    <div class="collapse" id="collapseactividad">
                        <div class="card card-body">
                          


                            <button id="botonNext" class="btn btn-primary" onclick="stepper2.next()">Next
                            </button>
                        </div>
                    </div>
                </div>




        <div class="col-md-12 mt-5">
    <h2>Non linear stepper</h2>
    <div id="stepper2" class="bs-stepper">
        <div class="bs-stepper-header">
            <div class="step" data-target="#test-nl-1">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">First step</span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-nl-2">
                <div class="btn step-trigger">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Second step</span>
                </div>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-nl-3">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">Third step</span>
                </button>

            </div>


        </div>
        <div class="bs-stepper-content">
            <div id="test-nl-1" class="content">
                <p class="text-center">test 3</p>
                <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
            </div>
            <div id="test-nl-2" class="content">
                <p class="text-center">test 4</p>
                <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
            </div>
            <div id="test-nl-3" class="content">
                <p class="text-center">test 5</p>
                <button class="btn btn-primary" onclick="stepper2.next()">Next</button>
                <button class="btn btn-primary" onclick="stepper2.previous()">Previous</button>
            </div>
        </div>
    </div>
</div>




        
    </div>

<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>



<script type="text/javascript">
       $(document).ready(function () {
         var stepper2 = new Stepper(document.querySelector('#stepper2'), {​​​​​
            linear: false,
            animation: true
        }​​​​​);
        });
</script>


</div>

@endsection

@push('scripts')

<script>
Dropzone.options.documentometodoDropzone = {
    url: '{{ route('admin.accion-correctivas.storeMedia') }}',
    maxFilesize: 4, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').find('input[name="documentometodo"]').remove()
      $('form').append('<input type="hidden" name="documentometodo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="documentometodo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($accionCorrectiva) && $accionCorrectiva->documentometodo)
      var file = {!! json_encode($accionCorrectiva->documentometodo) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="documentometodo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
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




$("#acollapseExample").click(function(){
  
  $("#acollapseExample").removeClass('btn btn-primary').addClass("btn btn-danger");
  $("#acollapseplan").removeClass('btn btn-danger').addClass("btn btn-primary");
});

$("#acollapseplan").click(function(){
    $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
  $(this).toggleClass("btn btn-danger");
  $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
});
$("#form-siguienteaccion").click(function(){
    $("#acollapseExample").removeClass('btn btn-danger').addClass("btn btn-primary");
  $("#acollapseplan").removeClass('btn btn-primary').addClass("btn btn-danger");
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

@endsection

@endpush

