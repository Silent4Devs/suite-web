<style>
    .select2-selection--multiple {
        overflow: hidden !important;
        height: auto !important;
        padding: 0 5px 5px 5px !important;
    }

    .select2-container {
        margin-top: 10px !important;
    }

</style>
<div class="row">
    <div class="col-12">
        <p class="text-muted"><i class="fas fa-info-circle"></i> Empieza configurando la evalución definiendo el
            nombre y la descripción</p>
    </div>
    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
        <div class="form-group">
            <label for="nombre">
                <i class="fab fa-discourse iconos-crear"></i> Nombre de la evaluación <span
                    class="text-danger">*</span>
            </label>
            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="nombre"
                aria-describedby="nombreHelp" name="nombre" value="{{ old('nombre') }}">
            <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre del
                Grupo</small>
            <span class="errors nombre_error text-danger"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
        <div class="form-group">
            <label for="descripcion">
                <i class="fab fa-discourse iconos-crear"></i> Descripción de la evaluación
            </label>
            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                id="" cols="30" rows="10">{{ old('descripcion') }}</textarea>
            <small id="descripcionHelp" class="form-text text-muted">Ingresa la Descripción la evaluación</small>
            <span class="errors descripcion_error text-danger"></span>
        </div>
    </div>
    <div class="col-12">
        <p class="text-muted"><i class="fas fa-info-circle"></i> Seleccionar Evaluados</p>
        <select class="form-control" id="evaluados_objetivo" name="evaluados_objetivo">
            <option value="" selected disabled>-- Seleciona una opción --</option>
            <option value="0">Grupos Dinámicos</option>
            <option value="1">Selección Manual</option>
        </select>
        <span class="errors evaluados_objetivo_error text-danger"></span>
        <select class="mt-2 mb-2 form-control" id="evaluados_grupo_dinamico" name="evaluados_grupo_dinamico"
            style="display: none">
            <option value="" selected disabled>-- Selecciona un grupo dinámico --</option>
            <option value="0">Toda la empresa</option>
            <option value="1">Areas</option>
        </select>
        <span class="errors evaluados_grupo_dinamico_error text-danger"></span>
        <select class="mt-2" id="evaluados_areas" name="evaluados_areas" style="display: none">
            <option value="" selected disabled>-- Selecciona un area --</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area }}</option>
            @endforeach
        </select>
        <span class="errors evaluados_areas_error text-danger"></span>

        <select class="mt-2" id="evaluados_manual" name="evaluados_manual[]" multiple style="display: none">
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
            @endforeach
        </select>
        <span class="errors evaluados_manual_error text-danger"></span>
        <small id="evaluadosQuestionHelp" class="form-text text-muted">Selecciona a quien(es) irá dirigida la
            evaluación</small>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('evaluados_objetivo').addEventListener('change', function(e) {
            let seleccion = Number(e.target.options[e.target.selectedIndex].value);
            if (seleccion === 0) {
                document.getElementById('evaluados_grupo_dinamico').style.display = 'block';
                // select manual
                if ($('#evaluados_manual').hasClass("select2-hidden-accessible")) {
                    $('#evaluados_manual').select2('destroy');
                }
                document.getElementById('evaluados_manual').style.display = 'none';
                // end select manual
                document.getElementById('evaluados_grupo_dinamico').addEventListener('change', function(
                    evt) {
                    let seleccionDinamico = Number(evt.target.options[evt.target.selectedIndex]
                        .value);
                    if (seleccionDinamico === 1) {
                        document.getElementById('evaluados_areas').style.display =
                            'block';
                        $('#evaluados_areas').select2({
                            theme: 'bootstrap4'
                        });
                    } else {
                        if ($('#evaluados_areas').hasClass("select2-hidden-accessible")) {
                            $('#evaluados_areas').select2('destroy');
                        }
                        document.getElementById('evaluados_areas').style.display =
                            'none';
                    }
                });
            } else {
                document.getElementById('evaluados_grupo_dinamico').style.display = 'none';
                // Select Areas                
                if ($('#evaluados_areas').hasClass("select2-hidden-accessible")) {
                    $('#evaluados_areas').select2('destroy');
                }
                document.getElementById('evaluados_areas').style.display =
                    'none';
                // end select areas
                document.getElementById('evaluados_manual').style.display = 'block';
                $('#evaluados_manual').select2({
                    theme: 'bootstrap4'
                });
            }
        })
    })
</script>
