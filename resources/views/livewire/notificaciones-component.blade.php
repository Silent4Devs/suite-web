<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link {{ $view == 'no-leidas' ? 'active' : '' }}" wire:click="unreadNotifications()">
                <i class="fas fa-cog fa-spin text-muted" wire:loading wire:target="unreadNotifications"></i>
                Notificaciones No Leídas
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link {{ $view == 'leidas' ? ' active' : '' }}" wire:click="notificationsReaded()"><i
                    class="fas fa-cog fa-spin text-muted" wire:loading wire:target="notificationsReaded"></i>
                Notificaciones Leídas
                {{-- <i class="fas fa-sync fa-spin"></i> --}}
            </button>
        </li>
    </ul>

    @include('livewire.notificaciones-'.$view)
</div>
