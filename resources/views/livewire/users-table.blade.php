<div>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th wire:click="sortBy('name')" class="text-primary" style="cursor: pointer;">
                Name
            </th>
            <th>Email</th>
            <th wire:click="sortBy('order')" class="text-primary" style="cursor: pointer;">
                Account Order
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
            <tr>
                <td>{{ $users->firstItem() + $key }}.</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->account->order }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
