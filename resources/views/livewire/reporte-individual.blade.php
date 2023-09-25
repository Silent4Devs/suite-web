<div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <div class="container-fluid mb-4">
        <div class="row justify-content-center row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
            @foreach ($clasificaciones as $clasif)
                <div class="col mt-4">
                    <div class="card card-body" style="background-color: #e0f4b8">
                        <h5>{{ $clasif->nombre_clasificaciones }}</h5><br>
                        <h6>1</h6>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-4">
                    <h6>Datos Generales*</h6>
                    <label class="form-label select-label">Clausulas</label>
                    <select id="textSelect" class="form-control select">
                        @foreach ($clausulas as $claus)
                            <option value="{{ $claus->id }}">{{ $claus->nombre_clausulas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">
        <a class="btn btn-primary"
            href="{{ route('admin.auditoria-internas.createReporteIndividual', $id_auditoria) }}">Crear Parte
            Interesada</a>
    </div>
    <div class="card card-body">
        <div class="row">
            <h4>Hallazgos</h4>
        </div>
        <div>

        </div>
    </div>
</div>
