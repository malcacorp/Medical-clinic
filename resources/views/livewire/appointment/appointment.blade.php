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
                        {{-- Doctor --}}
                        <label for="doctorSelected">{{ __('Doctor') }}</label>
                        <select id="doctorSelected" class="form-control" wire:model="doctorSelected" required>
                            <option value="">--{{ __('Select') }}--</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                            @endforeach
                        </select>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                {{-- Date --}}
                                <label class="mb-0" for="appointmentDate">{{ __('Date') }}</label>
                                <input type="date" id="appointmentDate" class="form-control" wire:model="appointmentDate" required>
                            </div>
                            <div class="col-md-6">
                                {{-- Time --}}
                                <label class="mb-0" for="appointmentTime">{{ __('Time') }}</label>
                                <input type="time" id="appointmentTime" class="form-control" wire:model="appointmentTime" required>
                            </div>
                        </div>
                        
                        {{-- Select Patient --}}
                        <label class="mt-2 mb-0" for="patient">{{ __('Patient Name') }}</label>
                        <select class="form-control w-100" wire:model="patient_id" id="patient" @if ($isEdit) disabled @endif>
                            <option value="">--{{ __('Select') }}--</option>
                            @foreach ($patients as $patient)
                                <option value={{ $patient->id }}>{{ $patient->first_name. " " .$patient->last_name }}</option>
                            @endforeach
                        </select>                        

                        <label class="mt-2 mb-0" for="assessment-type">{{__('Assessment Type')}}</label>
                        <select id="assessment-type" class="form-control" wire:model="assessment_type">
                            <option value="">--{{ __('Select') }}--</option>
                            <option value="Normal Assessment">{{__('Normal Assessment')}}</option>
                            <option value="Pressure control">{{__('Pressure control')}}</option>
                            <option value="Medical program">{{__('Medical program')}}</option>
                            <option value="Pediatrics">{{__('Pediatrics')}}</option>
                            <option value="Gynecology">{{__('Gynecology')}}</option>
                        </select>

                        {{-- Reason --}}
                        <label class="mt-2 mb-0" for="appointment-reason">{{__('Reason for medical appointment')}}</label>
                        <textarea class="form-control w-100" wire:model.lazy="medical_concerns" name="medical_concerns" required></textarea>

                        {{-- Buttons --}}
                        <div class="flex justify-content-center mt-4">
                          @if ($appointment)
                            <button type="button"
                                class="btn btn-danger text-white" wire:click="delete()">{{ __('Cancel Appointment') }}</button>                              
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
