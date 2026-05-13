<div class="card shadow mb-4">
  <div class="card-body">
    <div class="flex justify-content-center mt-4">
      <button class="btn btn-primary text-white mb-3" wire:click.prevent="handleTabs('isOpenCreate','isOpenHistories')"
          type="button">
          {{ __('Patient Profile') }}
      </button>
      {{-- <button class="btn btn-success text-white" wire:click.prevent="store()"
      type="button">
      {{ __('Save Patient') }}
    </button> --}}
    </div>
    <div class="table-responsive">
          <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>{{ __('Date') }}</th>
                      <th>{{ __('Assessment Type') }}</th>
                      <th>{{ __('Previous illnesses') }}</th>
                      <th>{{ __('Medical Condition') }}</th>
                      <th>{{ __('Diagnostic') }}</th>
                      <th>{{ __('Treatment') }}</th>
                      <th> </th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>{{ __('Date') }}</th>
                      <th>{{ __('Assessment Type') }}</th>
                      <th>{{ __('Previous illnesses') }}</th>
                      <th>{{ __('Medical Condition') }}</th>
                      <th>{{ __('Diagnostic') }}</th>
                      <th>{{ __('Treatment') }}</th>
                      <th> </th>
                  </tr>
              </tfoot>
              <tbody>
                  @forelse ($histories as $history)
                      <tr>
                          <td>
                              {{ $history->created_at }}
                          </td>
                          <td>
                              {{ $history->type_assessment }}
                          </td>
                          <td>
                              {{ $history->previous_illnesses }}
                          </td>
                          <td>
                              {{ $history->medical_condition }}
                          </td>
                          <td>
                              {{ $history->diagnostic }}
                          </td>
                          <td>
                              {{ $history->treatment }}
                          </td>
                          <td class="px-5">
                              <button wire:click="showHistory({{ $history->id }})"
                                  class="btn btn-primary btn-sm">{{ __('Show') }}</button>
                              {{-- <button wire:click="delete({{ $history->id }})"
                                  class="btn btn-danger btn-sm">Delete</button> --}}
                          </td>
                      </tr>
                  @empty
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <td colspan="6"
                              class="px-5 font-medium text-gray-900">
                              {{ __('No history found') }}
                          </td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>