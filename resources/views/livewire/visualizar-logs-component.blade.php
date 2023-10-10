<div>
    <table class="table table-bordered w-100 datatable-User">
        <thead class="thead-dark">
            <tr>

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
        @foreach ($articles as $item)
            <tr>
                <td>
                    {{ $item->user_id }}
                </td>
                <td>
                    {{ $item->event }}
                </td>
                <td>
                    {{ $item->old_values }}
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
    </table>
</div>
