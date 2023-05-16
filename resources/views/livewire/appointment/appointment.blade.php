<x-slot name="header">
    <h2 class="ms-4 h3">
        {{ __('Appointment') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="card shadow mx-auto col col-md-6 ">
        <div class="card-body w-100">
          @if (session()->has('message'))
                <div class="alert alert-info" role="alert">
                    <div class="flex">
                        {{ session('message') }}</p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col aling-items-center">
                    <form wire:submit.prevent="store" style="display: block">
                        @csrf
                        {{-- Date and Time --}}
                        <label for="appointment-date">Date and time</label>
                        <input type="date" class="form-control w-100" wire:model="date" id="appointment-date" name="date"
                            required>
                        <input type="time" class="form-control w-100 mt-3" wire:model="time" name="time" required>

                        {{-- Select Patient --}}
                        <label for="patient">Select patient</label>
                        <select class="form-control w-100" wire:model="patient_id" id="patient" @if ($isEdit) disabled @endif>
                            <option value="">-- Select --</option>
                            @foreach ($patients as $patient)
                                <option value={{ $patient->id }}>{{ $patient->first_name. " " .$patient->last_name }}</option>
                            @endforeach
                        </select>

                        {{-- Select Doctor --}}
                        <label for="doctor">Select doctor</label>
                        <select class="form-control w-100" wire:model="doctor_id" id="doctor" @if ($isEdit) disabled @endif>
                            <option value="">-- Select --</option>
                            @foreach ($doctors as $doctor)
                                <option value={{ $doctor->id }}>{{ $doctor->first_name }}</option>
                            @endforeach
                        </select>

                        {{-- Reason --}}
                        <label for="appointment-reason">Reason for medical appointment</label>
                        <textarea class="form-control w-100" wire:model.lazy="medical_concerns" name="medical_concerns" required></textarea>

                        {{-- Buttons --}}
                        <div class="flex justify-content-center mt-4">
                          @if ($appointment)
                            <button type="button"
                                class="btn btn-danger text-white" wire:click="delete()">{{ __('Cancel appointment') }}</button>                              
                          @endif
                            <a type="button" class="btn btn-secondary text-white" href="{{ route('appointments') }}">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-success text-white">{{ __('Submit') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
