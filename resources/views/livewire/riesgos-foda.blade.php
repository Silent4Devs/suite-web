<div class="row">
    <div class="col-12" wire:ignore>
        <select class="select2" id="seleccionAnalisis">
            <option value="">Selecciona un análisis</option>
            @foreach ($analisis as $a)
                <option value="{{$a->id}}">{{ $a->nombre }}</option>
            @endforeach
        </select>
    </div>

        <div class="col-12">

            <select multiple class="select2" id="seleccionRiesgos">
            @if ($riesgosPorAnalisis != null)
                @foreach ($riesgosPorAnalisis as $riesgoPorAnalisis)
                    <option value="{{$riesgoPorAnalisis->id}}">{{ Str::limit($riesgoPorAnalisis->descripcionriesgo, 50, '...') }}</option>
                @endforeach
            @endif
            </select>
        </div>


    <div class="col-12">
        <button type="button" class="btn btn-success" wire:click.defer="save">Guardar</button>
    </div>

    <div class="col-12">
        <table>
            <thead>
                <th>Id</th>
                <th>Descripción Riesgo</th>

            </thead>
            <tbody>
                @if($globalModel != null)
                @foreach ($globalModel->riesgos as $riesgoModel)
                <tr>
                    <td>{{$riesgoModel->id}}</td>
                    <td>{{$riesgoModel->descripcionriesgo}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#seleccionAnalisis').on('select2:select', function(e) {
                var data = e.params.data;
                @this.set('analisisSeleccionado',data.id);
                console.log(data);
            });
            $('#seleccionRiesgos').on('change', function (e) {
                console.log(e.target);
                let data = $(this).val();
                 @this.set('riesgosSeleccionados', data);
            });
            Livewire.on('select2', () => {
                initSelect2();
            })
            window.initSelect2 = () => {
                $('.select2').select2({
                    'theme': 'bootstrap4'
                });
            }
            initSelect2();
        })
    </script>

</div>
