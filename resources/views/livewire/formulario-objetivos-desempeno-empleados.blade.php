<div>
    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Nuevo Objetivo</h4>
            <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
            <hr class="my-4">
        </div>
        <div class="row">
            <div class="col-12 form-group anima-focus">
                <input wire:model="objetivo_estrategico" id="objetivo_estrategico" type="text" class="form-control"
                    placeholder="">
                <label for="objetivo_estrategico">Objetivo Estratégico</label>
            </div>
        </div>
        <div class="row">
            <div class="col-12 form-group anima-focus">
                <textarea wire:model="descripcion" name="descripcion" id="descripcion" cols="30" rows="10" placeholder=""
                    class="form-control"></textarea>
                <label for="descripcion">Descripción</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group anima-focus">
                <select wire:model="select_categoria" id="categoria" type="text" class="form-control" placeholder="">
                    <option value="">Seleccione Categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <label for="categoria">Categoría</label>
            </div>
            <div class="col-md-3 form-group anima-focus">
                <input wire:model="KPI" id="KPI" type="text" class="form-control" placeholder="">
                <label for="KPI">KPI</label>
            </div>
            <div class="col-md-6">
                <div class="d-flex" style="gap: 10px;">
                    <div class="form-group anima-focus w-100">
                        <select wire:model="select_unidad" id="unidad-medida" type="text" class="form-control"
                            placeholder="">
                            <option value="">Seleccione Unidad</option>
                            @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="unidad-medida">Unidad de medida</label>
                    </div>
                    <button class="btn btn-primary" style="height: 45px;" data-toggle="modal"
                        data-target="#modalUnidad">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button class="btn btn-primary" style="height: 45px;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalUnidad" tabindex="-1" role="dialog" aria-labelledby="modalUnidadLabel"
            aria-hidden="true" wire:ignore>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUnidadLabel">Crear Unidad de Medición para Objetivos
                            Estrategicos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal content goes here -->
                        {{-- This is the content of the modal. --}}
                        <div class="row">
                            <div class="col-12 form-group anima-focus">
                                <input wire:model="nombre_unidad" id="nombre_unidad" type="text" class="form-control"
                                    placeholder="">
                                <label for="nombre_unidad">Unidad</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group anima-focus">
                                <input wire:model="minimo_unidad" id="minimo_unidad" type="number" class="form-control"
                                    placeholder="">
                                <label for="minimo_unidad">Valor Minimo</label>
                            </div>
                            <div class="col-6 form-group anima-focus">
                                <input wire:model="maximo_unidad" id="maximo_unidad" type="number" class="form-control"
                                    placeholder="">
                                <label for="maximo_unidad">Valor Maximo</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a wire:click.prevent="crearUnidad" type="button" class="btn btn-primary"
                            data-dismiss="modal">Crear Unidad</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="p-3 rounded-lg" style="color: #818181; background-color: #FFFEE5;">
                    <i>
                        *Esta sección estará activa hasta que establezcas los periodos de la evaluación en la
                        <a href="" style="color: #006DDB; text-decoration: underline;">
                            Configuración de la Evaluación.
                        </a>
                        (Asigna un periodo para hacer estos ajustes en la calibración de objetivos)
                    </i>
                </div>
            </div>
        </div>

        <div class="mt-4" style="width: 300px;">
            <div class="form-group anima-focus">
                <div class="form-control" style="height: auto !important;">
                    <div class="d-flex flex-column py-3" style="gap: 15px;">
                        @for ($i = 0; $i < 3; $i++)
                            <div>
                                <input type="checkbox" name="" id="">
                                <label for="">Trimestre 1</label>
                            </div>
                        @endfor
                    </div>
                </div>
                <label for="">Periodos</label>
            </div>
        </div>


        <div class="info-first-config mt-5">
            <h4 class="title-config">Escalas del objetivo</h4>
            <p>Define las Escalas con los que se medirá este objetivo.</p>
            <hr class="my-4">
        </div>

        <div class="d-flex align-items-center" style="gap: 20px;">
            <input type="checkbox">
            <span><strong>Variante</strong></span>
            <span>Selecciona esta opción si deseas agregar una o más variantes a tus valores por periodo.</span>
        </div>

        <div class="mt-5">
            <table class="table-escalas-objetivos">
                <thead>
                    <tr>
                        <th>
                            No Satisfactorio
                        </th>
                        <th>
                            Mín. Requerido
                        </th>
                        <th>
                            Satisfactorio
                        </th>
                        <th>
                            Sobresaliente
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-tiems-center" style="gap: 20px;">
                                <div class="form-group anima-focus" style="width: 60px;">
                                    <input type="color" name="" id="" class="form-control">
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Condicional</label>
                                </div>
                                <div class="form-group anima-focus" style="min-width: 60px;">
                                    <input type="text" name="" id="" class="form-control">
                                    <label for="">Valor</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <a wire:click.prevent="crearObjetivo" class="btn btn-outline-primary"
                style="background-color: #ECFBFF; color: #006DDB; border-radius: 100px !important;">
                Agregar objetivo a la tabla <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>

    </div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Escalas del objetivo</h4>
            <hr class="my-4">
        </div>

        <div class="datatable-fix">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Objetivos Estratégicos</th>
                        <th>KPI</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Meta</th>
                        <th>Periodo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($objetivos as $obj)
                            <td>{{ $obj->categoria->nombre }}</td>
                            <td>{{ $obj->objetivo }}</td>
                            <td>{{ $obj->KPI }}</td>
                            <td>{{ $obj->descripcion }}</td>
                            <td>Estatus</td>
                            <td>{{ $obj->unidad->nombre }}</td>
                            <td>Periodo</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a> --}}
                                        <a class="dropdown-item"
                                            wire:click.prevent="enviarPapelera({{ $obj->id }})">Enviar a la
                                            Papelera</a>
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
