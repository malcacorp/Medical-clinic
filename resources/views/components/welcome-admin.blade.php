<div class="">
    <div class="row">
        <div class="col-sm-4 m-auto">
            <div class="card p-3 bg-primary" style="margin: 10px 0;">
                <h2 class="text-center text-white">Number of Patients</h2>
                <p class="text-center text-white">{{ $this->totalPatients }}</p>
            </div>
        </div>
        <div class="col-sm-4 m-auto">
            <div class="card p-3 bg-primary" style="margin: 10px 0;">
                <h2 class="text-center text-white">Appointments Today</h2>
                <p class="text-center text-white">{{ $this->totalAppointments }}</p>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 40px 0;">
        <div class="col-md-12">
            <h3 class="text-center" style="margin: 30px 0;">Appointments Today</h3>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-muted" style="vertical-align: middle;">Date and Time</th>
                                    <th class="text-muted" style="vertical-align: middle;">Name</th>
                                    <th class="text-muted" style="vertical-align: middle;">Doctor</th>
                                    <th class="text-muted" style="vertical-align: middle;">Phone Number</th>
                                    <th class="text-muted" style="vertical-align: middle;">Appointment Status</th>
                                    <th class="text-muted" style="vertical-align: middle;">Appointment Type</th>
                                    <th class="text-muted" style="vertical-align: middle;">Medical Concerns</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($this->appointments as $appointment)
                                <tr>
                                    <td>{{$appointment->date}}</td>
                                    <td>{{$appointment->patientName}}</td>
                                    <td>{{$appointment->doctorName}}</td>
                                    <td>{{$appointment->phone_number}}</td>
                                    <td>{{$appointment->status}}</td>
                                    <td>{{$appointment->assessment_type}}</td>
                                    <td>{{$appointment->medical_concerns}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
