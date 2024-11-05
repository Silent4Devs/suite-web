 <div class="dropdown-menu dropdown-menu-lg">
     @if (count($last_unread_notifications))
     <div wire:poll.60000ms>
         <div class="dropdown-header bg-light"><strong>Tú tienes {{ $notificaciones_sin_leer }}
                 notificaciones</strong>
         </div>
         @foreach ($last_unread_notifications as $last_unread_notification)
             @includeIf('items-notificaciones.item-'.$last_unread_notification->data['tabla'],[
             'last_unread_notification' => $last_unread_notification,
             'place' => 'notificaciones-campana',
             'readed' => false,
             ])
         @endforeach
         <a class="text-center dropdown-item border-top" href="{{ route('notificaciones') }}"><strong>Mostrar todas
                 las notificaciones</strong></a>
    </div>
     @else
        <div wire:poll.60000ms>
         <div class="text-center">
             {{ trans('global.no_alerts') }}
         </div>

        </div>
     @endif
 </div>
