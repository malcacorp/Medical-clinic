
    <div class="bg-light p-4 rounded">
        {{-- <h2>Permissions</h2> --}}
        {{-- <div class="lead">
            Manage your permissions here.
            <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
        </div> --}}
        
        {{-- <div class="mt-2">
            @include('layouts.partials.messages')
        </div> --}}

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Guard</th> 
                <th scope="col" colspan="3" width="1%"></th> 
            </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        {{-- route('permissions.edit', $permission->id) --}}
                        <td>
                          @can("edit-permission")
                            <a class="btn btn-info btn-sm" wire:click="edit({{ $permission->id }})">Edit</a></td>
                          @endcan
                        <td>
                          @can("delete-permission")
                            <button wire:click="delete({{ $permission->id }})"
                              class="btn btn-danger btn-sm">Delete</button>
                          @endcan                              
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
