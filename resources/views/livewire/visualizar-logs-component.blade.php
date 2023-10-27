<div>
    <table class="table">
        <thead>
            <tr>
                <th style="vertical-align: top">
                    ID
                </th>
                <th style="vertical-align: top">
                    User
                </th>
                <th style="vertical-align: top">
                    Event
                </th>
                <th style="vertical-align: top">
                    Old Value
                </th>
                <th style="vertical-align: top">
                    New value
                </th>
                <th style="vertical-align: top">
                    URL
                </th>
                <th style="vertical-align: top">
                    Tags
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        @php
                            $user = App\Models\User::select('id', 'name')->find($item->user_id);
                        @endphp
                        {{ $user->name ?? 'No user' }}
                    </td>
                    <td>
                        {{ $item->event }}
                    </td>
                    <td>
                        <p>{{ $item->old_values }}</p>
                    </td>
                    <td>
                        {{ $item->new_values }}
                    </td>
                    <td>
                        {{ $item->url }}
                    </td>
                    <td>
                        {{ $item->tags }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
</div>
