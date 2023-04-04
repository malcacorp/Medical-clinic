<div class="card shadow mb-4">
  <div class="card-body">
    <div class="flex justify-content-center mt-4">
      <button class="btn btn-primary text-white mb-3" wire:click.prevent="handleTabs('isOpenCreate','isOpenHistory')"
          type="button">
          {{ __('Patient Profile') }}
      </button>
      {{-- <button class="btn btn-success text-white" wire:click.prevent="store()"
      type="button">
      {{ __('Save Patient') }}
    </button> --}}
    </div>
    <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>Date</th>
                      <th>Type Assessment</th>
                      <th>Medical Condition</th>
                      <th>Diagnostic</th>
                      <th>Treatment</th>
                      <th> </th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>Date</th>
                      <th>Type Assessment</th>
                      <th>Medical Condition</th>
                      <th>Diagnostic</th>
                      <th>Treatment</th>
                      {{-- <th> </th> --}}
                  </tr>
              </tfoot>
              <tbody>
                  @forelse ($histories as $history)
                      <tr>
                          <td whitespace-nowrap">
                              {{ $history->created_at }}
                          </td>
                          <td whitespace-nowrap">
                              {{ $history->type_assessment }}
                          </td>
                          <td whitespace-nowrap">
                              {{ $history->medical_condition }}
                          </td>
                          <td whitespace-nowrap">
                              {{ $history->diagnostic }}
                          </td>
                          <td whitespace-nowrap">
                              {{ $history->treatment }}
                          </td>
                          {{-- <td class="px-5">
                              <button wire:click="edit({{ $history->id }})"
                                  class="btn btn-primary btn-sm">Edit</button>
                              <button wire:click="delete({{ $history->id }})"
                                  class="btn btn-danger btn-sm">Delete</button>
                          </td> --}}
                      </tr>
                  @empty
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <td colspan="2"
                              class="px-5 font-medium text-gray-900 whitespace-nowrap">
                              {{ __('No history found') }}
                          </td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>