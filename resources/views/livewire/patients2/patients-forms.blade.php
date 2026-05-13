<div>
  <x-slot name="header">
    <div class="d-flex align-items-center gap-3 ms-2 py-2">
        <div style="width:5px; height:36px; background: linear-gradient(180deg, #b91c1c, #7f1d1d); border-radius:3px; flex-shrink:0;"></div>
        <div>
            <h2 class="mb-0 fw-bold" style="font-size: 1.35rem; color: #111827; line-height: 1.2;">{{ __('Paciente') }}</h2>
            <span style="font-size: 0.8rem; color: #9ca3af;">{{ __('Registro y ficha del paciente') }}</span>
        </div>
    </div>
  </x-slot>
  
  <div class="py-4 px-2">
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
  
            @if ($isOpenPediatrics)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.form-pediatrics')
            @endif

            @if ($isOpenGynecology)
                @include('livewire.patients2.nav-pills')
                @include('livewire.patients2.form-gynecology')
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



