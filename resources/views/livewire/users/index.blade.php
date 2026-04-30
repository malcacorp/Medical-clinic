<x-slot name="header">
  <h2 class="ms-4 h3">
      {{ __('Users') }}
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
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-4">
                    <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">{{ __("Create") }} {{ __("User") }}</button>
                </div>
                <div class="col-lg-3 offset-lg-3 col-md-4 offset-md-4">
                    <input type="text" class="form-control mb-3" placeholder="{{ __('Search')}}..." aria-label="Buscar" wire:model="search">
                </div>
            </div>
            @include('livewire.users.list')
          @endif

          @if ($isOpenUpdate)
              {{-- @include('livewire.users.nav-pills') --}}
              @include('livewire.users.form')
          @endif

          @if ($isOpenShow)
              {{-- @include('livewire.users.nav-pills') --}}
              @include('livewire.users.show')
          @endif

      </div>
  </div>
</div>