<div class="bg-light p-4 rounded">
  <h1>{{ ucfirst($user->name) }} User</h1>
  <div class="lead">

  </div>

  <div class="container mt-4">

      <h3>Assigned roles</h3>

      <table class="table table-striped">
          <thead>
              <th scope="col" width="20%">{{ __("Name") }}</th>
              <th scope="col" width="1%">{{ __("Guard") }}</th>
          </thead>

          @foreach ($userRoles as $role)
              <tr>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->guard_name }}</td>
              </tr>
          @endforeach
      </table>
  </div>

</div>
<div class="mt-4">
  {{-- <a class="btn btn-info" wire:click.prevent="edit({{ $user->id }})">Edit</a> --}}
  <a class="btn btn-secondary" wire:click.prevent="handleTabs('isOpenList', 'isOpenShow')">Back</a>
</div>
