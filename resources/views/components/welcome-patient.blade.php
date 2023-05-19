<div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h2>Hello, {{ Auth::user()->name }}</h2>

            <h3>Welcome to clinic Hope Valencia</h3>

            <div class="text-center">
                <a class="btn btn-primary btn-lg my-5  mx-5 text-white" href="{{ route('schedule') }}">Book
                    Appointment</a>
                <a class="btn btn-primary btn-lg my-5  mx-5 text-white" href="{{ route('profile.show') }}">Update
                    Profile</a>
            </div>
            <div class="text-center">
                <h2>My Appointments</h2>
            </div>

            <div class="d-flex">
                <table class="table">
                    <thead>
                        <tr>
                            <th>With Doctor</th>
                            <th>Date</th>
                            <th>time</th>
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
                                    <button class="btn btn-secondary text-white text-right">Cancel Appointment</button>
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
