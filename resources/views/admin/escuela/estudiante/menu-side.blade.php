@if ($usuario->can('mis_cursos_instructor'))
    <div class="option-fixed-admin">

        @if ($usuario->can('mis_cursos_instructor'))
            <a class="btn" href="{{ route('admin.courses.index') }}">
                <img src="{{ asset('img/calendar-icon-time-config.svg') }}" alt="">
                Instructor
            </a>
        @endif
        <i class="bi bi-chevron-compact-right"
            style="position: absolute; top: 50%; transform: translateY(-50%); right: 3px;"></i>
    </div>
@endif
