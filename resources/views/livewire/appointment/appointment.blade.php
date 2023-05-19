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
                        <label for="selectedDate">Available Appointments</label>
                        <select id="selectedDate" class="form-control" wire:model="selectedDate">
                            <option value="">-- Select --</option>
                            @foreach ($availableDates as $availableDate)
                                <option value={{$availableDate->id."|".$availableDate->employee_id."|".$availableDate->date."|".$availableDate->time}}>{{ $availableDate->doctorName }} | {{ $availableDate->date }} | {{ $availableDate->time }}</option>
                            @endforeach
                        </select>
                        
                        {{-- Select Patient --}}
                        <label class="mt-2 mb-0" for="patient">Patient Name</label>
                        <select class="form-control w-100" wire:model="patient_id" id="patient" @if ($isEdit) disabled @endif>
                            <option value="">-- Select --</option>
                            @foreach ($patients as $patient)
                                <option value={{ $patient->id }}>{{ $patient->first_name. " " .$patient->last_name }}</option>
                            @endforeach
                        </select>                        

                        <label class="mt-2 mb-0" for="assessment-type">Type of Assessment</label>
                        <select id="assessment-type" class="form-control" wire:model="assessment_type">
                            <option value="">-- Select --</option>
                            <option value="Normal Assessment">Normal Assessment</option>
                            <option value="Presure control">Pressure control</option>
                            <option value="Medical program">Medical program</option>
                        </select>

                        {{-- Reason --}}
                        <label class="mt-2 mb-0" for="appointment-reason">Reason for medical appointment</label>
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
