<div>
    <x-loading-indicator />
    <div class="row mt-5">
        @include('partials.flashMessages')
        <div class="datatable-fix w-100 mt-4">
                <thead class="w-100">
            <table id="datatable_timesheet_semanas" class="table w-100">
                    <tr>
                        <th>Semana </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($horas_time as $hora)
                        <tr>
                            <td>semana</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                tablaLivewire('datatable_timesheet_semanas');
            });
        });
    </script>
</div>
