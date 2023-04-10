  <x-slot name="header">
      <h2 class="ms-4 h3">
          {{ __('Patients') }}
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
                      Patient</button>
                  @include('livewire.patients.list')
              @endif

              @if ($isOpenCreate)
                  @include('livewire.patients.nav-pills')
                  @include('livewire.patients.form')
              @endif

              @if ($isOpenCreateTwo)
                  @include('livewire.patients.nav-pills')
                  @include('livewire.patients.form-two')
              @endif

              @if ($isOpenCondition)
                  @include('livewire.patients.nav-pills')
                  @include('livewire.patients.form-condition')
              @endif

              @if ($isOpenConditionTwo)
                  @include('livewire.patients.nav-pills')
                  @include('livewire.patients.form-condition-two')
              @endif

              @if ($isOpenHistories)
                  @include('livewire.patients.nav-pills')
                  @include('livewire.patients.histories')
              @endif

              @if ($isShowHistory)
                  @include('livewire.patients.nav-pills')
                  @include('livewire.patients.history')
              @endif

          </div>
      </div>
  </div>
