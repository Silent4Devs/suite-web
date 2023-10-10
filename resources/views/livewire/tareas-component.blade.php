<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link {{ $view == 'no-leidas' ? 'active' : '' }}" wire:click="unreadTasks()">
                <i class="fas fa-cog fa-spin text-muted" wire:loading wire:target="unreadTasks"></i>
                Tareas Pendientes
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link {{ $view == 'leidas' ? ' active' : '' }}" wire:click="tasksReaded()">
                <i class="fas fa-cog fa-spin text-muted" wire:loading wire:target="tasksReaded"></i>
                Tareas Leídas
            </button>
        </li>
    </ul>
    @include('livewire.tareas-'.$view)
</div>
