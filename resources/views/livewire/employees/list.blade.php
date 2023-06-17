<div class="card shadow mb-4">
  <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>{{ __("Id") }}</th>
                      <th>{{ __("First name") }}</th>
                      <th>{{ __("Last name") }}</th>
                      <th>{{ __("Sex") }}</th>
                      <th>{{ __("Phone number") }}</th>
                      <th> </th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>{{ __("Id") }}</th>
                      <th>{{ __("First name") }}</th>
                      <th>{{ __("Last name") }}</th>
                      <th>{{ __("Sex") }}</th>
                      <th>{{ __("Phone number") }}</th>
                      <th> </th>
                  </tr>
              </tfoot>
              <tbody>
                  @forelse ($employees as $employee)
                      <tr>
                          <td whitespace-nowrap>
                              {{ $employee->id_number }}
                          </td>
                          <td whitespace-nowrap>
                              {{ $employee->first_name }}
                          </td>
                          <td whitespace-nowrap>
                              {{ $employee->last_name }}
                          </td>
                          <td whitespace-nowrap>
                              {{ $employee->sex }}
                          </td>
                          <td whitespace-nowrap>
                              {{ $employee->phone_number }}
                          </td>
                          <td class="px-5">
                            @can("edit-employee")
                              <button wire:click="edit({{ $employee->id }})"
                                  class="btn btn-primary btn-sm">{{ __("Edit") }}</button>
                            @endcan

                            @can("delete-employee")
                              <button wire:click="delete({{ $employee->id }})"
                                  class="btn btn-danger btn-sm">{{ __("Delete") }}</button>
                            @endcan

                            @can("view-staff-schedule")
                                @if ($employee->user->roles->contains('name', 'doctor'))
                                  <a type="button" class="btn btn-info btn-sm" href="{{ route('staff-schedule', $employee->id) }}">{{ __('View Schedule') }}</a>
                                @endif
                            @endcan

                          </td>
                      </tr>
                  @empty
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <td colspan="2"
                              class="px-5 font-medium text-gray-900 whitespace-nowrap">
                              {{ __('No employees found') }}
                          </td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>