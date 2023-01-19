 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
     @if (count($last_unread_notifications))
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
     @else
         <div class="text-center">
             {{ trans('global.no_alerts') }}
         </div>
     @endif
 </div>
