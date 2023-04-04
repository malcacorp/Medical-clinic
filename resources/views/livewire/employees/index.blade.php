<x-slot name="header">
  <h2 class="h4 font-weight-bold">
      {{ __('Staff') }}
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

          @if ($isOpenList)
              <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">Create New
                  Employee</button>
              @include('livewire.employees.list')
          @endif

          @if ($isOpenUpdate)
              {{-- @include('livewire.employees.nav-pills') --}}
              @include('livewire.employees.form')
          @endif

      </div>
  </div>
</div>
