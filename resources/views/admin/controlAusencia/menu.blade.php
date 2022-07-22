<ul class="mt-4">
      <li>
        <a href="vacaciones">
            <div>
                <i class="fas fa-plane-departure"></i>
                <br>
               Vacaciones
            </div>
        </a>
    </li>
 
    @can('beneficios_acceder')
    <li>
        <a href="dayOff">
            <div>
                <i class="fas fa-user-clock"></i>
                <br>
               Day Off´s
            </div>
        </a>
    </li>
    @endcan
    {{-- @can('timesheet_acceder')
    <li>
        <a href="#">
            <div>
                <i class="fas fa-hand-holding-usd"></i><br>
               Permisos con goce de sueldo
            </div>
        </a>
    </li>
    @endcan --}}
    @can('timesheet_acceder')
    <li>
        <a href="incidentes-vacaciones">
            <div>
                <i class="fas fa-hand-holding-usd"></i><br>
               Incidentes vacaciones
            </div>
        </a>
    </li>
    @endcan
</ul>
