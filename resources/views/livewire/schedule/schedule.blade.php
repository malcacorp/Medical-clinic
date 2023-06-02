<section>
    <div class="row justify-content-center my-5">
        <div class="col-md-12">
            <x-slot name="header">
                <h2 class="ms-4 h3">
                    {{ __('Schedule') }}
                </h2>
            </x-slot>
            @if (!$isAdmin && !$isEmployee)
            <button id="add-appointment-button" class="btn btn-primary text-white rounded m-3">Create
                appointment</button>
            @endif
            <button id="show-appointment-button" class="btn btn-primary text-white rounded m-3 d-none">Show
                appointment</button>
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
                    <div id='calendar-container' wire:ignore>
                        <div id='calendar'></div>
                        {{-- {{$title}} --}}
                    </div>

                    {{-- @livewire('schedule', ['title' => 'Mi título'])
                    <livewire:schedule wire:props="{ title: 'Mi título' }" /> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-appointment-modal" tabindex="-1" role="dialog"
        aria-labelledby="add-appointment-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-appointment-modal-label">{{__('New Appointment')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="closeModal('add-appointment-modal')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-appointment-form">
                        <div class="form-group">
                            <label for="availability">{{ __('Available Appointments') }}</label>
                            <select id="availability" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach ($availableDates as $availableDate)
                                    <option value={{ $availableDate->id."|".$availableDate->employee_id."|".$availableDate->date."|".$availableDate->time }}>{{ $availableDate->doctorName }} | {{ $availableDate->date }} | {{ $availableDate->time }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assessment-type">{{__('Assessment Type')}}</label>
                            <select id="assessment-type" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="Normal Assessment">Normal Assessment</option>
                                <option value="Presure control">Pressure control</option>
                                <option value="Medical program">Medical program</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="appointment-reason">{{__('Reason for medical appointment')}}</label>
                            <textarea type="text" class="form-control" id="appointment-reason" placeholder="{{__('Reason for medical appointment')}}"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="closeModal('add-appointment-modal')">{{__('Close')}}</button>
                    <button type="button" class="btn btn-primary text-white" id="save-appointment-button">{{__('Submit')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-appointment-modal" tabindex="-1" role="dialog"
        aria-labelledby="show-appointment-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-appointment-modal-label">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="closeModal('show-appointment-modal')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <label>{{ __('Date') }}: {{ $currentAppointmentDate }}</label>
                    </div>
                    <div class="row">
                        <label>Time: {{ $currentAppointmentTime }}</label>
                    </div>
                    <div class="row">
                        <label>Patient: {{ $currentAppointmentPatient }}</label>
                    </div>
                    <div class="row">
                        <label>{{ __('Phone number') }}: {{ $currentAppointmentPhone }}</label>
                    </div>
                    <div class="row">
                        <label>Reason: {{ $currentAppointmentReason }}</label>
                    </div>

                </div>
                <div class="modal-footer">
                    @if ($isEmployee || $isAdmin)
                        <button type="button" class="btn btn-warning"
                            wire:click="openProfile({{ $currentAppointmentPatientId }})" data-dismiss="modal"
                            onclick="closeModal('add-appointment-modal')">Patient</button>
                    @endif
                    <button type="button" class="btn btn-danger text-white"
                        wire:click="cancelAppointment({{ $currentAppointmentPatientId }})">{{__('Cancel Appointment')}}</button>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"onclick=" closeModal('show-appointment-modal')">Close</button>
                    {{-- <button type="button" class="btn btn-primary text-white" id="save-appointment-button">Submit</button> --}}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var data = @this.events;
            var calendar = new Calendar(calendarEl, {
                events: JSON.parse(data),
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                slotDuration: '00:30:00', //  1 hour interval
                defaultTimedEventDuration: '00:30:00',
                dateClick(info) {
                    // console.log(info.dateStr);
                    if (@this.isEmployee) {
                        if (info.dateStr.length <= 10) {
                            var start = prompt('Ingrese una hora en la que estará disponible:', '08:00:00');
                            var date = info.dateStr + 'T' + start;
                        } else {
                            var date = info.dateStr;
                        }

                        if (info.dateStr.length <= 10 && (start == "" || start == null)) {
                            alert('Time Is Required');
                        } else {
                            if (date != null && date != '') {
                                // calendar.addEvent({
                                //   title: "Available",
                                //   start: date,
                                //   // end: end
                                // });
                                var eventAdd = {
                                    title: 'Available',
                                    start: date
                                };
                                @this.addevent(eventAdd);
                                // alert('Great. Now, update your database...');
                            } else {
                                alert('Date and Time Is Required');
                            }
                        }
                    } else {
                        let date;
                        if (info.dateStr.length <= 10) {
                            // document.getElementById('appointment-start').value = info.dateStr + "T08:00";
                            date = info.dateStr;
                        } else {
                            const arrDate = info.dateStr.split('T');
                            const date = arrDate[0];
                            const arrTime = arrDate[1].split("-");
                            const time = arrTime[0]
                            // document.getElementById('appointment-start').value = date + "T" + time;
                        }
                        // $('#add-appointment-button').click();
                    }
                },
                eventClick: function(info) {
                    // console.log(info);
                    // if(@this.isEmployee){
                    //   if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
                    //       @this.removeEvent(info.event.id);
                    //       calendar.getEventById(info.event.id).remove();
                    //       // @this.emit('refreshCalendar');
                    //       // Livewire.emit('eliminarEvento', );
                    //   }
                    // }
                    if (info.event.title.includes("Appointment") || info.event.title.includes("APPOINTMENT")) {
                        @this.showAppointment(info.event.id);
                        setTimeout(function() {
                            $('#show-appointment-button').click();
                        }, 200);
                    }else{
                        const arrDate = info.event.startStr.split('T');
                        let date = arrDate[0];
                        
                        @this.updateSelectedDate(info.event.id);
                        setTimeout(function() {
                            $('#add-appointment-button').click();
                        }, 200);
                    }
                },
                // timeFormat: 'h:mm A', // formato de 12 horas con AM/PM
                editable: true,
                selectable: true,
                displayEventTime: true,
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                eventDrop: (info) => {
                    @this.eventDrop(info.event, info.oldEvent)
                },
                loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e) {
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                }
            });

            calendar.render();
            @this.on(`refreshCalendar`, () => {
                calendar.refetchEvents()
            });

            @this.on('updateSelectedDate', function(eventId, eventIdDoctor, eventDate, eventTime) {               
                document.getElementById("availability").value = eventId+"|"+eventIdDoctor+"|"+eventDate+"|"+eventTime;
            });

            @this.on('eventAdded', function(eventId, eventTitle, eventStart) {
                var event = {
                    id: eventId,
                    title: "{{ __ ('" + eventTitle + "') }}",
                    start: eventStart,
                };
                calendar.addEvent(event);
            });

            @this.on('eventRemoved', function(eventId) {
                // Busca el evento por ID
                var event = calendar.getEventById(eventId);
                // Elimina el evento del calendario
                event.remove();
            });

            @this.on('doctorNotExists', function() {
                alert("Esta opción sólo está disponible para médicos");
            });

            @this.on('isNotPatient', function() {
                alert("Esta opción sólo está disponible para pacientes");
            });

            @this.on('notAvailability', function() {
                alert("No hay disponibilidad a esta hora con este doctor");
            });

            // Open modal for creating appointment
            document.getElementById('add-appointment-button').addEventListener('click', function() {
                $('#add-appointment-modal').modal('show');
            });

            // Open modal for showing appointment
            document.getElementById('show-appointment-button').addEventListener('click', function() {
                $('#show-appointment-modal').modal('show');
            });

            // Guarda el evento en el calendario cuando se hace clic en el botón correspondiente dentro del modal
            document.getElementById('save-appointment-button').addEventListener('click', function() {              
                const availability = document.getElementById('availability').value;
                const reason = document.getElementById('appointment-reason').value;
                const assessmentType = document.getElementById('assessment-type').value;

                if (availability == null || availability == "") {
                    alert("{{__('Select a available date for medical appointment')}}");
                    return;
                }

                if (assessmentType == null || assessmentType == "") {
                    alert("{{__('Write an assessment type for medical appointment')}}");
                    return;
                }

                if (reason == null || reason == "") {
                    alert("{{__('Write a reason for medical appointment')}}");
                    return;
                }                

                let data = document.getElementById("availability").value.split('|')

                // let date = document.getElementById('appointment-start').value;
                // let strDate = 'abcdefghij';
                // const char = ',';
                // const position = 10;

                // strDate = date.substring(0, position) + char + date.substring(position);
                // const arrDate = strDate.split(',T');
                var appointment = {
                    doctorId: data[1],
                    medical_concerns: document.getElementById('appointment-reason').value,
                    assessment_type: document.getElementById('assessment-type').value,
                    date: data[2],
                    time: data[3]
                    // end: document.getElementById('appointment-end').value
                };
                @this.addAppointment(appointment);
                $('#add-appointment-modal').modal('hide');
            });

        });

        const closeModal = (id) => {
            $('#' + id).modal('hide');
        }
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush
