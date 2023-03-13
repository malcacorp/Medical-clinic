  <x-slot name="header">
      <h2 class="h4 font-weight-bold">
          {{ __('Patients') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="mx-auto">
          <div class="">
              @if (session()->has('message'))
                  <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                      role="alert">
                      <div class="flex">
                          <div>
                              <p class="text-sm">{{ session('message') }}</p>
                          </div>
                      </div>
                  </div>
              @endif
              <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">Create New
                  Patient</button>
              @if ($isOpen)
                  @include('livewire.patients.create')
              @else
                  <div class="card shadow mb-4">
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                      <tr>
                                          <th>Id Number</th>
                                          <th>First name</th>
                                          <th>Last name</th>
                                          <th>Sex</th>
                                          <th>Phone number</th>
                                          <th> </th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>Id Number</th>
                                          <th>First name</th>
                                          <th>Last name</th>
                                          <th>Sex</th>
                                          <th>Phone number</th>
                                          <th> </th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                      @forelse ($patients as $patient)
                                          <tr>
                                              <td whitespace-nowrap">
                                                  {{ $patient->id_number }}
                                              </td>
                                              <td whitespace-nowrap">
                                                  {{ $patient->first_name }}
                                              </td>
                                              <td whitespace-nowrap">
                                                  {{ $patient->last_name }}
                                              </td>
                                              <td whitespace-nowrap">
                                                  {{ $patient->sex }}
                                              </td>
                                              <td whitespace-nowrap">
                                                  {{ $patient->phone_number }}
                                              </td>
                                              <td class="px-5">
                                                  <button wire:click="edit({{ $patient->id }})"
                                                      class="btn btn-primary btn-sm">Edit</button>
                                                  <button wire:click="delete({{ $patient->id }})"
                                                      class="btn btn-danger btn-sm">Delete</button>
                                              </td>
                                          </tr>
                                      @empty
                                          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                              <td colspan="2"
                                                  class="px-5 font-medium text-gray-900 whitespace-nowrap">
                                                  {{ __('No patients found') }}
                                              </td>
                                          </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              @endif
          </div>
      </div>
  </div>
