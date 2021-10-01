<div>
    <div class="mb-3 row">
        <div class="col-8">
            <input class="form-control" type="text" wire:model.debounce.800ms="search" placeholder="Buscar competencia...">
        </div>
        <div class="col-4">
            <select wire:model.debounce.800ms="filter" class="form-control">
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($competencias->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Competencia</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competencias as $competencia)
                    <tr>
                        <th scope="row"><input wire:model.debounce.800ms="selected" value="{{ $competencia->id }}" type="checkbox">
                        </th>
                        <td>{{ $competencia->nombre }}</td>
                        <td>{{ $competencia->tipo->nombre }}</td>
                        <td>{{ $competencia->descripcion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $competencias->links() !!}
    @else
        <p class="text-center"><i class="mr-2 fas fa-exclamation-triangle"></i>Opps... No hemos encontrado ninguna
            competencia</p>
    @endif
</div>
