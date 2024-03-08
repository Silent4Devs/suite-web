<div>
    <div class="pasos-create-evaluaciones mb-5">
        <div class="paso-create-ev">
            <span>1</span>
            inicio
        </div>
        <hr>
        <div class="paso-create-ev">
            <span>2</span>
            Periodos
        </div>
        <hr>
        <div class="paso-create-ev">
            <span>3</span>
            Público
        </div>
        <hr>
        <div class="paso-create-ev">
            <span>4</span>
            Evaluadores
        </div>
    </div>

    @switch($paso)
        @case('1')
            <div class="tab-content" id="nav-create-1" role="tabpanel" aria-labelledby="nav-create-1">
                <div>
                    <div class="card card-body">
                        <div class="info-first-config">
                            <h4 class="title-config">Nombre de Evaluación</h4>
                            <p>Asigna un nombre a tu evaluación y coloca una breve descripción.</p>
                            <hr class="my-4">
                        </div>

                        <div class="form-group anima-focus">
                            <input type="text" placeholder="" name="nombre_evaluacion" wire:model="nombre_evaluacion"
                                class="form-control">
                            <label for="nombre-evaluacion">Nombre</label>
                        </div>

                        <div class="form-group anima-focus">
                            <textarea placeholder="" name="descripcion_evaluacion" wire:model="descripcion_evaluacion" class="form-control"></textarea>
                            <label for="descripcion-evaluacion">Descripción</label>
                        </div>
                    </div>

                    <div class="card card-body">
                        <div class="info-first-config">
                            <h4 class="title-config">Alcance de la Evaluación</h4>
                            <p>
                                Selecciona los rubros que deseas considerar en tu evaluación. Podrás distribuir el
                                porcentaje
                                que prefieras asignar a cada una de ellos, asegurándote de sumar en total el 100%."
                            </p>
                            <hr class="my-4">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span style="color: #3086AF;">Una ventana de</span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="p-4 rounded-lg d-flex align-items-center justify-content-between"
                                    style="background-color: #8C91D6;">
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <input type="checkbox" name="activar_objetivos" wire:model="activar_objetivos">
                                        <label for="activar_objetivos" style="color: #fff;" class="mb-0"> Objetivos
                                        </label>
                                    </div>
                                    <div>
                                        <input type="number" wire:model="porcentaje_objetivos" name="porcentaje_objetivos"
                                            style="width: 90px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 rounded-lg d-flex align-items-center justify-content-between"
                                    style="background-color: #BB68A8;">
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <input type="checkbox" name="activar_competencias" wire:model="activar_competencias">
                                        <label for="activar_competencias" style="color: #fff;" class="mb-0"> Competencias
                                        </label>
                                    </div>
                                    <div>
                                        <input type="number" wire:model="porcentaje_competencias"
                                            name="porcentaje_competencias" style="width: 90px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right my-4">
                        <a href="" class="btn btn-outline-primary" style="width: 170px;">ATRÁS</a>
                        <a wire:click.prevent="primerPaso" class="btn btn-success" style="width: 170px;">SIGUIENTE</a>
                    </div>
                </div>
            </div>
        @break

        @case('2')
            <div class="tab-content" id="nav-create-2" role="tabpanel" aria-labelledby="nav-create-2">
                <div class="card card-body">
                    <div class="info-first-config">
                        <h4 class="title-config">Periodos de los Objetivos</h4>
                        <p>Define la periodicidad con la que se medirá la evaluación de tu empresa.</p>
                        <hr class="my-4">
                    </div>
                    <div>
                        Selecciona la periodicidad
                    </div>
                    <div class="d-flex mt-3" style="gap: 20px;">
                        <div class="form-group">
                            <input type="checkbox" name="" id="">
                            <label class="mb-0" for="">Mensual</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="" id="">
                            <label class="mb-0" for="">Bimestral</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="" id="">
                            <label class="mb-0" for="">Semestral</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="" id="">
                            <label class="mb-0" for="">Anual</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="" id="">
                            <label class="mb-0" for="">Abierta</label>
                        </div>
                    </div>

                    <hr>

                    <div class="card card-body p-2 " style="background-color: #FFF3F3; color: #3086AF; font-size: 12px;">
                        <div>
                            El periodo de carga de objetivos esta corriendo del <strong> 01/01/24 </strong> al <strong> 15/03/24
                            </strong>
                            <i class="ml-3">*Al cambiar y habilitar las fechas de los periodos de las evaluaciones se
                                interrumpirá la carga de objetivos</i>
                        </div>
                    </div>

                    <div class="datatable-fix">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Periodicidad: Trimestral</th>
                                    <th>Fecha de inicio de la evaluación</th>
                                    <th>Fecha de fin de la evaluación</th>
                                    <th>Habilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i < 5; $i++)
                                    <tr>
                                        <td>
                                            <div class="form-group anima-focus">
                                                <input type="text" name="" id="" class="form-control">
                                                <label for="">Evaluación*</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group anima-focus">
                                                <input type="date" placeholder="" class="form-control">
                                                <label for="">Inicio de la evaluación</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group anima-focus">
                                                <input type="date" placeholder="" class="form-control">
                                                <label for="">Fin de la evaluación</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right my-4">
                    <a href="" class="btn btn-outline-primary" style="width: 170px;">ATRÁS</a>
                    <a href="" class="btn btn-success" style="width: 170px;">SIGUIENTE</a>
                </div>
            </div>
        @break

        @case('3')
            <div class="tab-content" id="nav-create-3" role="tabpanel" aria-labelledby="nav-create-3">
                <div class="card card-body">
                    <div class="info-first-config">
                        <h4 class="title-config">Público</h4>
                        <p>Selecciona a quien(es) va dirigida la evaluación o crea un nuevo grupo.</p>
                        <hr class="my-4">
                    </div>
                    <div class="d-flex align-items-center" style="gap: 20px;">
                        <select name="" id="" class="form-control" style="max-width: 350px;">
                            <option value="" selected disabled>Toda la empresa</option>
                        </select>

                        <button class="btn btn-outline-primary">
                            CREAR&nbsp;GRUPO
                        </button>
                    </div>
                </div>
                <div class="text-right my-4">
                    <a href="" class="btn btn-outline-primary" style="width: 170px;">ATRÁS</a>
                    <a href="" class="btn btn-success" style="width: 170px;">SIGUIENTE</a>
                </div>
            </div>
        @break

        @case('4')
            <div class="tab-content" id="nav-create-4" role="tabpanel" aria-labelledby="nav-create-4">
                <div class="card card-body">
                    <div class="info-first-config">
                        <h4 class="title-config">Evaluador(es) de objetivos: Toda la empresa</h4>
                        <p>Asigna a los evaluadores y su porcentaje de evaluacións</p>
                        <hr class="my-4">
                    </div>
                </div>
                <div class="text-right my-4">
                    <a href="" class="btn btn-outline-primary" style="width: 170px;">ATRÁS</a>
                    <a href="" class="btn btn-success" style="width: 170px;">SIGUIENTE</a>
                </div>
            </div>
        @break

        @default
    @endswitch




</div>
