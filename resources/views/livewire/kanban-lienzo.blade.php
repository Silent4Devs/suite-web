<div>

    <div wire:sortable="updateGroupOrder" wire:sortable-group="updateTaskOrder" style="display: flex">
        @foreach ($groups as $group)
            <div wire:key="group-{{ $group->id }}" wire:sortable.item="{{ $group->id }}">
                <div style="display: flex">
                    <h4 wire:sortable.handle>{{ $group->label }}</h4>

                    <button wire:click="removeGroup({{ $group->id }})">Remove</button>
                </div>

                <ul wire:sortable-group.item-group="{{ $group->id }}">
                    @foreach ($group->tasks as $task)
                        <li wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}">
                            {{ $task->title }}
                            <button wire:click="removeTask({{ $task->id }})">Remove</button>
                        </li>
                    @endforeach
                </ul>

                <form wire:submit.prevent="addTask({{ $group->id }}, $event.target.title.value)">
                    <input type="text" name="title">

                    <button>Add Task</button>
                </form>
            </div>
        @endforeach

        <form wire:submit.prevent="addGroup">
            <input type="text" wire:model.defer="newGroupLabel">

            <button>Add Task Group</button>
        </form>
    </div>
</div>
