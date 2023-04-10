<x-slot name="header">
  <h2 class="ms-4 h3">
      {{ __('Staff') }}
  </h2>
</x-slot>

<div class="py-12">
  <div class="mx-auto">
      <div class="">
          @if (session()->has('message'))
              <div class="alert alert-info" role="alert">
                  <div class="flex">
                      {{ session('message') }}</p>
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
