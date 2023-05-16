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

            <button wire:click="create()" class="btn btn-primary text-white py-1 m-4 px-3 rounded">Create New Appointment</button>



            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col" width="15%">Patient</th>
                            <th scope="col" width="15%">Reason</th>
                            <th scope="col" width="15%">Doctor</th>
                            <th scope="col" width="15%">Date</th>
                            <th scope="col" width="15%">Time</th>
                            <th scope="col" colspan="3" width="1%"></th>
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
                                {{-- <td>{{ $appointment->guard_name }}</td> --}}

                                <td>
                                    <a class="btn btn-info btn-sm" wire:click="edit({{ $appointment->appointment_id }})">Edit</a>

                                </td>
                                <td>
                                    {{-- <button wire:click="show({{ $appointment->appointment_id }})"
                                        class="btn btn-success btn-sm">Show</button> --}}
                                    {{-- <button wire:click="show({{ $appointment->id }})"
                                        class="btn btn-success btn-sm">Show</button> --}}

                                </td>
                                <td>

                                    {{-- <button wire:click="delete({{ $appointment->appointment_id }})"
                                        class="btn btn-danger btn-sm">Delete</button> --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                </div>





                {{-- @if ($isOpenList)
          @endif --}}

                {{-- @if ($isOpenUpdate)
              @include('livewire.roles.nav-pills')
              @include('livewire.appointment.form')
          @endif

          @if ($isOpenShow)
              @include('livewire.roles.nav-pills')
              @include('livewire.appointment.show')
          @endif --}}

            </div>
        </div>
    </div>
