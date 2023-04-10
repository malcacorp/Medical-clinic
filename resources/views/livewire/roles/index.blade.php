<x-slot name="header">
  <h2 class="ms-4 h3">
      {{ __('Roles') }}
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
                  Role</button>
              @include('livewire.roles.list')
          @endif

          @if ($isOpenUpdate)
              {{-- @include('livewire.roles.nav-pills') --}}
              @include('livewire.roles.form')
          @endif

          @if ($isOpenShow)
              {{-- @include('livewire.roles.nav-pills') --}}
              @include('livewire.roles.show')
          @endif

      </div>
  </div>
</div>