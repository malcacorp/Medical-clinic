
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
          <th scope="col" width="15%">Name</th>
          <th scope="col">Guard</th> 
          <th scope="col" colspan="3" width="1%"></th> 
      </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
              <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->guard_name }}</td>
                  <td><a class="btn btn-info btn-sm" wire:click="edit({{ $user->id }})">Edit</a></td>
                  <td>
                    <button wire:click="show({{ $user->id }})"
                      class="btn btn-success btn-sm">Show</button>
                  </td>
                  <td>
                    <button wire:click="delete({{ $user->id }})"
                      class="btn btn-danger btn-sm">Delete</button>                      
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>

</div>
