@props(['livewire' => false])

<div class="row mb-2">
    <div class="col-12 col-md-6 px-4">
        <x-label for="first_name" value="{{ __('First name') }}" />
        <input id="first_name" class="form-control block mt-1 w-full" type="text" name="first_name" required autofocus
            autocomplete="first_name" {{ $livewire ? 'wire:model=first_name' : ":value=old('first_name')" }} />
    </div>
    <div class="col-12 col-md-6 px-4">
        <x-label for="last_name" value="{{ __('Last name') }}" />
        <input id="last_name" class="form-control block mt-1 w-full" type="text" name="last_name" required
            autocomplete="last_name" {{ $livewire ? 'wire:model=last_name' : ":value=old('last_name')" }} />
    </div>
</div>

<div class="row mb-2">
    <div class="col-12 col-md-6 px-4">
        <x-label for="id_number" value="{{ __('Id Number') }}" />
        <x-input id="id_number" class="form-control block mt-1 w-full" type="number" name="id_number" :value="old('id_number')" required
            autocomplete="id_number" {{ $livewire ? 'wire:model=id_number' : "" }} />
    </div>
    <div class="col-12 col-md-6 px-4">
        <x-label for="sex" value="{{ __('Sex') }}" />
        <select class="form-select" name="sex" {{ $livewire ? 'wire:model=sex' : ":value=old('sex')" }}>
            <option value="Male">{{ __('Male') }}</option>
            <option value="Female">{{ __('Female') }}</option>
        </select>
    </div>
</div>

<div class="row mb-2">
    <div class="col-12 col-md-6 px-4">
        <x-label for="phone_number" value="{{ __('Phone number') }}" />
        <x-input id="phone_number" class="form-control block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required
            autocomplete="phone_number" {{ $livewire ? 'wire:model=phone_number' : "" }} />
    </div>
    <div class="col-12 col-md-6 px-4">
        <x-label for="birthdate" value="{{ __('Birthdate') }}" />
        <input id="birthdate" class="form-control block mt-1 w-full" type="date" name="birthdate" required
            autocomplete="birthdate"
            {{ $livewire ? 'wire:model=birthdate' : ":value=old('birthdate')" }} />
    </div>
</div>

<div class="row mb-2">
    <div class="col-12 col-md-6 px-4">
        <x-label for="height" value="{{ __('Height') }}" />
        <input id="height" class="form-control block mt-1 w-full" type="text" name="height" autocomplete="height"
            {{ $livewire ? 'wire:model=height' : ":value=old('height')" }} />
    </div>
    <div class="col-12 col-md-6 px-4">
        <x-label for="weight" value="{{ __('Weight') }}" />
        <input id="weight" class="form-control block mt-1 w-full" type="text" name="weight" autocomplete="weight"
            {{ $livewire ? 'wire:model=weight' : ":value=old('weight')" }} />
    </div>
</div>

<div class="row mb-2">
    <div class="col-12 col-md-6 px-4">
        <x-label for="eye_color" value="{{ __('Eye color') }}" />
        <input id="eye_color" class="form-control block mt-1 w-full" type="text" name="eye_color"
            autocomplete="eye_color" {{ $livewire ? 'wire:model=eye_color' : ":value=old('eye_color')" }} />
    </div>
</div>

<div class="row mb-2">
    <div class="col-12 col-md-6 px-4">
        <x-label for="address" value="{{ __('Address') }}" />
        <textarea id="address" class="form-control form-control block mt-1 w-full" type="text" name="address"
            autocomplete="address" {{ $livewire ? 'wire:model=address' : ":value=old('address')" }}></textarea>
    </div>
    <div class="col-12 col-md-6 px-4">
        <x-label for="medical_condition" value="{{ __('Medical Condition') }}" />
        <textarea id="medical_condition" class="form-control form-control block mt-1 w-full" type="text"
            name="medical_condition" autocomplete="medical_condition"
            {{ $livewire ? 'wire:model=medical_condition' : ":value=old('medical_condition')" }}></textarea>
    </div>
    <div class="col-12 col-md-6 px-4">
        <x-label for="previous_illnesses" value="{{ __('Previous Illnesses') }}" />
        <textarea id="previous_illnesses" class="form-control form-control block mt-1 w-full" type="text"
            name="previous_illnesses" autocomplete="previous_illnesses"
            {{ $livewire ? 'wire:model=previous_illnesses' : ":value=old('previous_illnesses')" }}></textarea>
    </div>
</div>
