<div class="bg-light p-4 rounded">
    {{-- <h2>Permissions</h2> --}}
    {{-- <div class="lead">
      Manage your roles here.
      <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add roles</a>
  </div> --}}

    {{-- <div class="mt-2">
      @include('layouts.partials.messages')
  </div> --}}
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" width="15%">{{ __("Name") }}</th>
                    <th scope="col">{{ __("Guard") }}</th> 
                    <th scope="col" colspan="3" width="1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            @can('edit-role')
                                <a class="btn btn-info btn-sm" wire:click="edit({{ $role->id }})">{{ __("Edit") }}</a>
                            @endcan
                        </td>
                        <td>
                            @can('show-role')
                                <button wire:click="show({{ $role->id }})" class="btn btn-success btn-sm"> {{ __("Show") }} </button>
                            @endcan
                        </td>
                        <td>
                            @can('delete-role')
                                <button wire:click="delete({{ $role->id }})"
                                    class="btn btn-danger btn-sm"> {{__("Delete")}} </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      <div>
</div>
