<x-slot name="header">
    <h2 class="ms-4 h3">
        {{ __('Appointment') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                <div class="row">

                    <div class="col col-md-5 aling-items-center">

                        <form wire:submit.prevent="store" style="display: block">
                            @csrf
                            {{-- Date and Time --}}
                            <label for="appointment-date">Date and time</label>
                            <input type="date" class="form-control" wire:model.lazy="date" id="appointment-date"
                                name="date" required>
                            <input type="time" class="form-control" wire:model.lazy="time" name="time"
                                required>

                            {{-- Select Doctor --}}
                            <label for="doctor">Select doctor</label>
                            <select class="form-control" wire:model="doctor_id" id="doctor">
                                <option value="">-- Select --</option>
                                @foreach ($doctors as $doctor)
                                    <option value={{ $doctor->id }}>{{ $doctor->first_name }}</option>
                                @endforeach
                            </select>

                            {{-- Reason --}}
                            <label for="appointment-reason">Reason for medical appointment</label>
                            <textarea class="form-control" wire:model.lazy="medical_concerns" name="medical_concerns" required></textarea>

                            {{-- Buttons --}}
                            <div class="flex justify-content-center mt-4">
                                <button type="button"
                                    class="btn btn-dark text-white">{{ __('Delete appointment') }}</button>
                                <button type="button" class="btn btn-danger text-white">{{ __('Back') }}</button>
                                <button type="submit" class="btn btn-success text-white">{{ __('Submit') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
