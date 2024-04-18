<div>
    <div class="card card-body">
        <form wire:submit.prevent="search(Object.fromEntries(new FormData($event.target)))">
            <div class="row">
                <div class="col-md-5 ">
                    <div class="form-group ">
                        <label for="">Seleccione Proyecto</label>
                        <select name="proyecto" id="" class="form-control">
                            <option value="" disabled selected></option>
                            @foreach ($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">
                                    {{ $proyecto->proyecto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 form-group">
                    <label for="">Fecha</label>
                    <input type="month" name="mes" class="form-control">
                </div>
                <div class="col-md-2 form-group">
                    <br>
                    <button class="btn btn-primary">
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <canvas id="graf-financiero-1" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <canvas id="graf-financiero-2" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
