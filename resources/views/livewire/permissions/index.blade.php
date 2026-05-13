<x-slot name="header">
  <h2 class="ms-4 h3">
      {{ __('Permissions') }}
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
              <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">{{ __("Create") }} {{ __('Permissions') }}</button>
              @include('livewire.permissions.list')
          @endif

          @if ($isOpenUpdate)
              {{-- @include('livewire.permissions.nav-pills') --}}
              @include('livewire.permissions.form')
          @endif

      </div>
  </div>
</div>