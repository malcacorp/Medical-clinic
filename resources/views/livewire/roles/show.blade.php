<div class="bg-light p-4 rounded">
    <h1>{{ ucfirst($role->name) }} Role</h1>
    <div class="lead">

    </div>

    <div class="container mt-4">

        <h3>Assigned permissions</h3>

        <table class="table table-striped">
            <thead>
                <th scope="col" width="20%">Name</th>
                <th scope="col" width="1%">Guard</th>
            </thead>

            @foreach ($rolePermissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                </tr>
            @endforeach
        </table>
    </div>

</div>
<div class="mt-4">
    <a class="btn btn-info" wire:click.prevent="handleTabs('isOpenUpdate', 'isOpenShow')">Edit</a>
    <a class="btn btn-default" wire:click.prevent="handleTabs('isOpenList', 'isOpenShow')">Back</a>
</div>
