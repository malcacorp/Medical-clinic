<div class="bg-light p-4 rounded">
  {{-- <h2>Add new role</h2>
      <div class="lead">
          Add new role.
      </div> --}}

  <div class="container mt-4">
      <form method="POST">
          @csrf
          <div class="mb-3">
              <label for="name" class="form-label">{{ __('Name') }}</label>
              <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" wire:model="name"
                  required>

              @if ($errors->has('name'))
                  <span class="text-danger text-left">{{ $errors->first('name') }}</span>
              @endif
          </div>

          <label for="permissions" class="form-label">{{ __('Assign Permissions') }}</label>

                <table class="table table-striped">
                    <thead>
                      {{-- <input type="checkbox" name="all_permission"> --}}
                        <th scope="col" width="1%"></th>
                        <th scope="col" width="20%">Name</th>
                        <th scope="col" width="1%">Guard</th> 
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" 
                                name="permission[{{ $permission->name }}]"
                                value="{{ $permission->name }}"
                                class='permission'
                                {{ in_array($permission->name, $rolePermissions) 
                                    ? 'checked'
                                    : '' }} wire:model="rolePermissions">
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>

          <button class="btn btn-primary" wire:click.prevent="store()">Save role</button>
          <a class="btn btn-secondary" wire:click.prevent="handleTabs('isOpenList', 'isOpenUpdate')">{{ __('Back') }}</a>
      </form>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
      $('[name="all_permission"]').on('click', function() {
          if($(this).is(':checked')) {
              $.each($('.permission'), function() {
                  $(this).prop('checked',true);
              });
          } else {
              $.each($('.permission'), function() {
                  $(this).prop('checked',false);              });
          }
          
      });
  });
</script>