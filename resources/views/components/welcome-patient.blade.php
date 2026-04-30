<div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h2>{{__('Hello!')}} {{ Auth::user()->name }}</h2>

            <h3>{{ __('Welcome to clinic La Esperanza Valencia') }}</h3>

            <div class="text-center">
                <a class="btn btn-primary btn-lg my-5  mx-5 text-white" href="{{ route('schedule') }}">{{__('Book Appointment')}}</a>
                <a class="btn btn-primary btn-lg my-5  mx-5 text-white" href="{{ route('profile.show') }}">{{__('Update Profile')}}</a>
            </div>
            <div class="text-center">
                <h2>{{__('My Appointments')}}</h2>
            </div>

            <div class="d-flex">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{__('With Doctor')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Time')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->patient->appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->employee->first_name . ' ' . $appointment->employee->last_name }}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->time }}</td>
                                <td>
                                    <button class="btn btn-secondary text-white text-right">{{__('Cancel Appointment')}}</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex-grow-1 text-center">
                </div>
            </div>

        </div>
    </div>
</div>
