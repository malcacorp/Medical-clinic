<div class="bg-light p-4 rounded">
  {{-- <h2>Add new user</h2>
      <div class="lead">
          Add new user.
      </div> --}}

  <div class="container mt-4">
      <form method="POST">
          @csrf
          <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" wire:model="name"
                  required>

              @if ($errors->has('name'))
                  <span class="text-danger text-left">{{ $errors->first('name') }}</span>
              @endif
          </div>

          {{-- <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input value="{{ old('email') }}" type="text" class="form-control" name="email" placeholder="Name" wire:model="email"
                  required>

              @if ($errors->has('email'))
                  <span class="text-danger text-left">{{ $errors->first('email') }}</span>
              @endif
          </div> --}}

          <label for="roles" class="form-label">Assign Roles</label>

                <table class="table table-striped">
                    <thead>
                      {{-- <input type="checkbox" name="all_role"> --}}
                        <th scope="col" width="1%"></th>
                        <th scope="col" width="20%">Name</th>
                        <th scope="col" width="1%">Guard</th> 
                    </thead>

                    @foreach($roles as $role)
                        <tr>
                            <td>
                                <input type="checkbox" 
                                name="role[{{ $role->name }}]"
                                value="{{ $role->name }}"
                                class='role'
                                {{ in_array($role->name, $userRoles) 
                                    ? 'checked'
                                    : '' }} wire:model="userRoles">
                            </td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>

          <button class="btn btn-primary" wire:click.prevent="store()">Save user</button>
          <a class="btn btn-secondary" wire:click.prevent="handleTabs('isOpenList', 'isOpenUpdate')">Back</a>
      </form>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
      $('[name="all_role"]').on('click', function() {
          if($(this).is(':checked')) {
              $.each($('.role'), function() {
                  $(this).prop('checked',true);
              });
          } else {
              $.each($('.role'), function() {
                  $(this).prop('checked',false);              });
          }
          
      });
  });
</script>