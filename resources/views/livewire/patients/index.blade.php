  <x-slot name="header">
      <h2 class="h4 font-weight-bold">
          {{ __('Patient List') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="mx-auto">
          <div class="bg-white overflow-hidden shadow-xl rounded-lg">
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
              <div class="relative overflow-x-auto shadow-md rounded-lg">
                  <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">Create New
                      Patient</button>
                  @if ($isOpen)
                      @include('livewire.patients.create')
                  @else
                  {{-- @if ($updateMode)
                      @include('livewire.update')
                  @else
                      @include('livewire.create')
                  @endif --}}
                  {{-- <x-link href="{{ route('patients.create') }}" class="m-4">Add new patient</x-link> --}}
                  <table class="w-100 text-sm text-left text-gray-500 text-gray-400 px-3">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 bg-gray-700 text-gray-400">
                          <tr>
                              <th scope="col" class="px-5 py-3">
                                  Id Number
                              </th>
                              <th scope="col" class="px-5 py-3">
                                  First name
                              </th>
                              <th scope="col" class="px-5 py-3">
                                  Last name
                              </th>
                              <th scope="col" class="px-5 py-3">
                                  Sex
                              </th>
                              <th scope="col" class="px-5 py-3">
                                  Phone number
                              </th>
                              <th scope="col" class="px-5 py-3">

                              </th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($patients as $patient)
                              <tr class="bg-white border-b bg-gray-800 border-gray-700">
                                  <td class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap">
                                      {{ $patient->id_number }}
                                  </td>
                                  <td class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap">
                                      {{ $patient->first_name }}
                                  </td>
                                  <td class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap">
                                      {{ $patient->last_name }}
                                  </td>
                                  <td class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap">
                                      {{ $patient->sex }}
                                  </td>
                                  <td class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap">
                                      {{ $patient->phone_number }}
                                  </td>
                                  <td class="px-5 py-4">
                                    <button wire:click="edit({{ $patient->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $patient->id }})" class="btn btn-danger btn-sm">Delete</button>
                                      {{-- <a href="{{ route('patients.edit', $patient) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                  </td>
                              </tr>
                          @empty
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                  <td colspan="2" class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap">
                                      {{ __('No patients found') }}
                                  </td>
                              </tr>
                          @endforelse
                      </tbody>
                  </table>
                  @endif
              </div>
          </div>
      </div>
  </div>
