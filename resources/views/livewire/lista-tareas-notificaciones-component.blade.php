 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
     @if (count($last_unread_notifications))
         <div class="dropdown-header bg-light"><strong>Tú tienes {{ $notificaciones_sin_leer }}
                 tareas</strong>
         </div>
         @foreach ($last_unread_notifications as $last_unread_notification)
             @includeIf('items-tareas.item-'.$last_unread_notification->data['tabla'],[
             'last_unread_notification' => $last_unread_notification,
             'place' => 'tareas',
             'readed' => false,
             ])
         @endforeach
         <a class="text-center dropdown-item border-top" href="{{ route('tareas') }}"><strong>Mostrar todas las
                 notificaciones</strong></a>
     @else
         <div class="text-center">
             {{ trans('global.no_alerts') }}
         </div>
     @endif
 </div>
