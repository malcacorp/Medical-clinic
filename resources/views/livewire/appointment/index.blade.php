<x-slot name="header">
    <h2 class="ms-4 h3">
        {{ __('Appointments') }}
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

            <div class="row align-items-center">
                <div class="col-lg-6 col-md-4">
                    <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">{{ __('Create') }}
                        {{ __('Appointment') }}</button>
                </div>
                <div class="col-lg-3 offset-lg-3 col-md-4 offset-md-4">
                    <input type="text" class="form-control mb-3" placeholder="{{ __('Search')}}..." aria-label="Buscar" wire:model="search">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col" width="16%">{{ __('Patient') }}</th>
                            <th scope="col" width="16%">{{ __('Reason') }}</th>
                            <th scope="col" width="16%">{{ __('Doctor') }}</th>
                            <th scope="col" width="16%">{{ __('Date') }}</th>
                            <th scope="col" width="16%">{{ __('Time') }}</th>
                            <th scope="col" width="16%">{{ __('Status') }}</th>
                            <th scope="col" width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient_name }}</td>
                                <td>{{ $appointment->medical_concerns }}</td>
                                <td>{{ $appointment->doctor_name }}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->time }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>
                                    @if ($appointment->status == 'Pending') 
                                        <a class="btn btn-info btn-sm" wire:click="edit({{ $appointment->appointment_id }})">{{ __('Edit') }}</a>
                                        {{-- <a class="btn btn-danger btn-sm" wire:click="cancel({{ $appointment->appointment_id }})">{{ __('Cancel') }}</a> --}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
