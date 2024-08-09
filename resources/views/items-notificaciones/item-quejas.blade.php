<div class="d-flex align-items-center justify-content-between">
    <div style="{{ $place == 'notificaciones-page' ? 'flex-basis: calc(80% - 5px)' : 'flex-basis:100%' }}">
        <a class="dropdown-item text-secondary"
            href="{{ route('admin.desk.quejas-edit', $last_unread_notification->data['id']) }}">
            @switch(" ".$last_unread_notification->data['type']) {{-- Se concatena un espacio porque el autoformateado lo agrega en el case --}}
                @case(' create')
                    <div class="d-flex align-items-center justify-content-start">
                        @if (!empty($last_unread_notification->data['avatar_ruta']))
                            <img src="{{ asset($last_unread_notification->data['avatar_ruta']) }}" alt=""
                                class="rounded-circle" style="width: 50px; height: 50px;">
                            {{ $last_unread_notification->data['name'] }}:
                        @else
                            <i class="pr-2 fas fa-tasks text-success"></i>
                        @endif
                        &nbsp;&nbsp;
                        <p class="p-0 m-0">Nueva {{ $last_unread_notification->data['slug'] }} creada</p>
                    </div>
                @break

                @case(' update')
                    <div class="d-flex align-items-center justify-content-start">
                        @if (!empty($last_unread_notification->data['avatar_ruta']))
                            <img src="{{ asset($last_unread_notification->data['avatar_ruta']) }}" alt=""
                                class="rounded-circle" style="width: 50px; height: 50px;">
                            {{ $last_unread_notification->data['name'] }}:
                        @else
                            <i class="pr-2 fas fa-tools text-info"></i>
                        @endif
                        &nbsp;&nbsp;
                        <p class="p-0 m-0">
                            En la {{ $last_unread_notification->data['slug'] }} {{ $last_unread_notification->data['id']}}  a solicitado su firma
                        </p>
                    </div>
                @break

                @case(' delete')
                    <div class="d-flex align-items-center justify-content-start">
                        @if (!empty($last_unread_notification->data['avatar_ruta']))
                            <img src="{{ asset($last_unread_notification->data['avatar_ruta']) }}" alt=""
                                class="rounded-circle" style="width: 50px; height: 50px;">
                            {{ $last_unread_notification->data['name'] }}:
                        @else
                            <i class="pr-2 fas fa-tools text-danger"></i>
                        @endif
                        &nbsp;&nbsp;
                        <p class="p-0 m-0">
                            La {{ $last_unread_notification->data['slug'] }} con fecha
                            {{ \Carbon\Carbon::parse($last_unread_notification->data['deleted_at'] ?? null)->format('d M Y, h:i A') ?? '' }} ha
                            sido eliminada
                        </p>
                    </div>
                @break

                @default
            @endswitch
        </a>
    </div>
    @if ($place == 'notificaciones-page')
        <div class="text-muted" style="flex-basis: calc(15% - 2px)">
            <i class="fas fa-clock"></i>
            {{ \Carbon\Carbon::parse($last_unread_notification->data['time'])->diffForHumans() }}
        </div>
        @if (!$readed)
            <div style="flex-basis: calc(5% - 2px)">
                <span class="btn-read" data-toggle="tooltip" data-placement="top" title="Marcar como leído"
                    wire:click="markAsRead('{{ $last_unread_notification->id }}')">
                    <i class="fas fa-check"></i>
                </span>
            </div>
        @endif
    @endif
</div>
