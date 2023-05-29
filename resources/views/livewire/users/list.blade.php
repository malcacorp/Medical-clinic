
<div class="bg-light p-4 rounded">
  {{-- <h2>Permissions</h2> --}}
  {{-- <div class="lead">
      Manage your users here.
      <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add users</a>
  </div> --}}
  
  {{-- <div class="mt-2">
      @include('layouts.partials.messages')
  </div> --}}

  <table class="table table-striped">
      <thead>
      <tr>
          <th scope="col" width="15%">{{ __("Name") }}</th>
          <th scope="col">{{ __("Guard") }}</th> 
          <th scope="col" colspan="3" width="1%"></th> 
      </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
              <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->guard_name }}</td>
                  <td>
                    @can("edit-user")
                      <a class="btn btn-info btn-sm" wire:click="edit({{ $user->id }})">{{ __("Edit") }}</a>
                    @endcan
                  </td>
                  <td>
                    @can("show-user")
                      <button wire:click="show({{ $user->id }})"
                        class="btn btn-success btn-sm">{{ __("Show") }}</button>
                    @endcan
                  </td>
                  <td>
                    @can("delete-user")
                      <button wire:click="delete({{ $user->id }})"
                        class="btn btn-danger btn-sm">{{ __("Delete") }}</button>
                    @endcan                  
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>

</div>
