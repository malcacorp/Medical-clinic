<div>
  <x-slot name="header">
    <h2 class="ms-4 h3">
        {{ __('Patient') }}
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
  
  
            @if ($isOpenCreate)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.form')
            @endif
  
            @if ($isOpenCreateTwo)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.form-two')
            @endif
  
            @if ($isOpenCondition)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.form-condition')
            @endif
  
            @if ($isOpenConditionTwo)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.form-condition-two')
            @endif
  
            @if ($isOpenHistories)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.histories')
            @endif
  
            @if ($isShowHistory)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.history')
            @endif
  
        </div>
    </div>
  </div>
</div>



