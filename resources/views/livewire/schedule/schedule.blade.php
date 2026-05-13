<section>

    {{-- ========== PAGE HEADER ========== --}}
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3 ms-2 py-2">
            <div style="width:5px; height:36px; background: linear-gradient(180deg, #b91c1c, #7f1d1d); border-radius:3px; flex-shrink:0;"></div>
            <div>
                <h2 class="mb-0 fw-bold" style="font-size: 1.35rem; color: #111827; line-height: 1.2;">{{ __('Agenda') }}</h2>
                <span style="font-size: 0.8rem; color: #9ca3af;">{{ __('Calendario de citas y disponibilidad') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center mb-5">
        <div class="col-md-12">

            {{-- ========== DOCTOR FILTER TABS ========== --}}
            <div class="schedule-filter-wrapper mb-3">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <a class="schedule-doctor-tab {{ ($doctorSelected=='all') ? 'active' : '' }}"
                       href="{{ route('schedule') }}">
                        <i class="fas fa-users me-1"></i>
                        {{ __('Todos los Doctores') }}
                    </a>
                    @foreach ($allDoctors as $doctor)
                        <a class="schedule-doctor-tab {{ ($doctorSelected==$doctor->id) ? 'active' : '' }}"
                           href="{{ route('staff-schedule', $doctor->id) }}">
                            <i class="fas fa-user-md me-1"></i>
                            {{ $doctor->first_name . ' ' . $doctor->last_name }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- ========== CALENDAR CARD ========== --}}
            <div class="card" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header d-flex align-items-center justify-content-between py-3 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="schedule-legend">
                            <span class="legend-dot legend-dot--appointment"></span>
                            {{ __('Cita') }}
                        </span>
                        <span class="schedule-legend">
                            <span class="legend-dot legend-dot--available"></span>
                            {{ __('Disponible') }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div id='calendar-container' wire:ignore>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ========== HIDDEN TRIGGER BUTTONS ========== --}}
    @if (!$isAdmin && !$isEmployee)
        <button id="add-appointment-button" class="d-none" onclick="$('#add-appointment-modal').modal('show')"></button>
    @endif
    <button id="show-appointment-button" class="d-none" onclick="$('#show-appointment-modal').modal('show')"></button>

    {{-- ========== ADD APPOINTMENT MODAL ========== --}}
    <div class="modal fade" id="add-appointment-modal" tabindex="-1" aria-labelledby="add-appointment-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="border-bottom: 1px solid #f3f4f6; padding: 1.5rem 1.75rem;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon-badge modal-icon-badge--red">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <h5 class="modal-title fw-bold mb-0" id="add-appointment-modal-label">{{ __('Nueva Cita') }}</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="closeModal('add-appointment-modal')"></button>
                </div>
                <div class="modal-body" style="padding: 1.5rem 1.75rem;">
                    <form id="add-appointment-form">
                        <div class="mb-3">
                            <label for="availability" class="schedule-label">
                                <i class="fas fa-clock me-1 text-muted"></i>
                                {{ __('Citas Disponibles') }}
                            </label>
                            <select id="availability" class="form-control">
                                <option value="">— {{ __('Seleccionar') }} —</option>
                                @foreach ($availableDates as $availableDate)
                                    <option value="{{ $availableDate->id.'|'.$availableDate->employee_id.'|'.$availableDate->date.'|'.$availableDate->time }}">
                                        {{ $availableDate->doctorName }} | {{ $availableDate->date }} | {{ $availableDate->time }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assessment-type" class="schedule-label">
                                <i class="fas fa-stethoscope me-1 text-muted"></i>
                                {{ __('Tipo de Evaluación') }}
                            </label>
                            <select id="assessment-type" class="form-control">
                                <option value="">— {{ __('Seleccionar') }} —</option>
                                <option value="Normal Assessment">{{ __('Evaluación Normal') }}</option>
                                <option value="Presure control">{{ __('Control de Presión') }}</option>
                                <option value="Medical program">{{ __('Programa Médico') }}</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="appointment-reason" class="schedule-label">
                                <i class="fas fa-notes-medical me-1 text-muted"></i>
                                {{ __('Motivo de la Cita') }}
                            </label>
                            <textarea class="form-control" id="appointment-reason" rows="3"
                                placeholder="{{ __('Describa el motivo de la consulta...') }}"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f3f4f6; padding: 1rem 1.75rem;">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('add-appointment-modal')">{{ __('Cancelar') }}</button>
                    <button type="button" class="btn btn-primary text-white" id="save-appointment-button">
                        <i class="fas fa-check me-1"></i>
                        {{ __('Guardar Cita') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ========== SHOW APPOINTMENT MODAL ========== --}}
    <div class="modal fade" id="show-appointment-modal" tabindex="-1" aria-labelledby="show-appointment-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="border-bottom: 1px solid #f3f4f6; padding: 1.5rem 1.75rem;">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon-badge modal-icon-badge--dark">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h5 class="modal-title fw-bold mb-0" id="show-appointment-modal-label">{{ __('Detalle de Cita') }}</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="closeModal('show-appointment-modal')"></button>
                </div>
                <div class="modal-body" style="padding: 1.5rem 1.75rem;">
                    <div class="appointment-detail-grid">
                        <div class="appointment-detail-item">
                            <span class="appointment-detail-label"><i class="fas fa-calendar me-2"></i>{{ __('Fecha') }}</span>
                            <span class="appointment-detail-value">{{ $currentAppointmentDate }}</span>
                        </div>
                        <div class="appointment-detail-item">
                            <span class="appointment-detail-label"><i class="fas fa-clock me-2"></i>{{ __('Hora') }}</span>
                            <span class="appointment-detail-value">{{ $currentAppointmentTime }}</span>
                        </div>
                        <div class="appointment-detail-item">
                            <span class="appointment-detail-label"><i class="fas fa-user me-2"></i>{{ __('Paciente') }}</span>
                            <span class="appointment-detail-value">{{ $currentAppointmentPatient }}</span>
                        </div>
                        <div class="appointment-detail-item">
                            <span class="appointment-detail-label"><i class="fas fa-phone me-2"></i>{{ __('Teléfono') }}</span>
                            <span class="appointment-detail-value">{{ $currentAppointmentPhone }}</span>
                        </div>
                        <div class="appointment-detail-item" style="grid-column: 1 / -1;">
                            <span class="appointment-detail-label"><i class="fas fa-notes-medical me-2"></i>{{ __('Motivo') }}</span>
                            <span class="appointment-detail-value">{{ $currentAppointmentReason }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f3f4f6; padding: 1rem 1.75rem;">
                    @if ($isEmployee || $isAdmin)
                        <button type="button" class="btn btn-info text-white"
                            wire:click="openProfile({{ $currentAppointmentPatientId }})" data-bs-dismiss="modal"
                            onclick="closeModal('show-appointment-modal')">
                            <i class="fas fa-user me-1"></i>
                            {{ __('Ver Paciente') }}
                        </button>
                    @endif
                    <button type="button" class="btn btn-danger text-white"
                        wire:click="cancelAppointment({{ $currentAppointmentPatientId }})">
                        <i class="fas fa-times me-1"></i>
                        {{ __('Cancelar Cita') }}
                    </button>
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('show-appointment-modal')">{{ __('Cerrar') }}</button>
                </div>
            </div>
        </div>
    </div>

</section>

<style>
/* ============ SCHEDULE FILTER TABS ============ */
.schedule-filter-wrapper {
    background: #fff;
    border-radius: 14px;
    padding: 1rem 1.25rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.schedule-doctor-tab {
    display: inline-flex;
    align-items: center;
    padding: 0.45rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #374151;
    background: #f3f4f6;
    border: 1.5px solid transparent;
    text-decoration: none;
    transition: all 0.25s ease;
    white-space: nowrap;
}

.schedule-doctor-tab:hover {
    background: #fee2e2;
    color: #b91c1c;
    border-color: #fca5a5;
    text-decoration: none;
}

.schedule-doctor-tab.active {
    background: #b91c1c;
    color: #ffffff;
    border-color: #b91c1c;
    box-shadow: 0 4px 10px rgba(185, 28, 28, 0.3);
}

/* ============ LEGEND ============ */
.schedule-legend {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #6b7280;
}

.legend-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.legend-dot--appointment { background: #b91c1c; }
.legend-dot--available   { background: #10b981; }

/* ============ CUSTOM EVENT CHIPS ============ */

/* Remove default fc-event background so our custom element takes over */
.fc-daygrid-event {
    background: transparent !important;
    border: none !important;
    padding: 1px 2px !important;
    margin-bottom: 2px !important;
}

/* ---- Available slot chip ---- */
.fc-event-avail {
    display: flex;
    align-items: center;
    gap: 4px;
    background: linear-gradient(90deg, #d1fae5, #ecfdf5);
    border: 1px solid #6ee7b7;
    border-radius: 20px;
    padding: 2px 8px 2px 5px;
    font-size: 0.7rem;
    font-weight: 600;
    color: #065f46;
    cursor: pointer;
    transition: all 0.2s ease;
    overflow: hidden;
    white-space: nowrap;
}

.fc-event-avail:hover {
    background: linear-gradient(90deg, #059669, #10b981);
    border-color: #059669;
    color: #fff;
    transform: scale(1.03);
    box-shadow: 0 2px 8px rgba(5, 150, 105, 0.35);
}

.fc-event-avail:hover .fc-event-avail__dot {
    background: #fff;
}

.fc-event-avail__dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #059669;
    flex-shrink: 0;
    transition: background 0.2s;
}

.fc-event-avail__time {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.02em;
}

.fc-event-avail__label {
    font-size: 0.68rem;
    font-weight: 500;
    opacity: 0.8;
}

.fc-event-avail__arrow {
    margin-left: auto;
    font-size: 0.8rem;
    font-weight: 800;
    opacity: 0.6;
    line-height: 1;
}

/* ---- Appointment chip ---- */
.fc-event-appt {
    display: flex;
    align-items: center;
    gap: 5px;
    background: linear-gradient(90deg, #b91c1c, #dc2626);
    border-radius: 8px;
    padding: 3px 8px;
    font-size: 0.7rem;
    font-weight: 700;
    color: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
    overflow: hidden;
    white-space: nowrap;
    box-shadow: 0 2px 6px rgba(185,28,28,0.35);
}

.fc-event-appt:hover {
    transform: scale(1.03);
    box-shadow: 0 4px 12px rgba(185,28,28,0.5);
}

.fc-event-appt__icon {
    font-size: 0.75rem;
    flex-shrink: 0;
}

.fc-event-appt__body {
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.fc-event-appt__time {
    font-size: 0.65rem;
    opacity: 0.85;
    font-weight: 500;
}

.fc-event-appt__title {
    font-size: 0.7rem;
    font-weight: 700;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 120px;
}

/* ============ FULLCALENDAR OVERRIDES ============ */
.fc .fc-toolbar-title {
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: #111827 !important;
}

.fc .fc-button-primary {
    background-color: #111827 !important;
    border-color: #111827 !important;
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    border-radius: 7px !important;
    padding: 0.35rem 0.85rem !important;
    transition: all 0.2s ease !important;
}

.fc .fc-button-primary:hover {
    background-color: #b91c1c !important;
    border-color: #b91c1c !important;
}

.fc .fc-button-primary:not(:disabled).fc-button-active {
    background-color: #b91c1c !important;
    border-color: #b91c1c !important;
}

.fc .fc-col-header-cell-cushion {
    font-size: 0.82rem;
    font-weight: 700;
    color: #374151;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-decoration: none;
}

.fc .fc-daygrid-day-number {
    color: #374151;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
}

.fc .fc-daygrid-day.fc-day-today {
    background-color: rgba(185, 28, 28, 0.05) !important;
}

.fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
    background: #b91c1c;
    color: #fff;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
}

/* Calendar Events */
.fc-event {
    border-radius: 6px !important;
    border: none !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    padding: 2px 6px !important;
    cursor: pointer !important;
}

/* Appointment events → Red */
.fc-event[style*="#"] {
    border-radius: 6px !important;
}

/* ============ MODAL ENHANCEMENTS ============ */
.modal-icon-badge {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.modal-icon-badge--red {
    background: #fee2e2;
    color: #b91c1c;
}

.modal-icon-badge--dark {
    background: #f3f4f6;
    color: #374151;
}

.schedule-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.4rem;
}

/* ============ APPOINTMENT DETAIL GRID ============ */
.appointment-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.appointment-detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    background: #f9fafb;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    border: 1px solid #f3f4f6;
}

.appointment-detail-label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #9ca3af;
}

.appointment-detail-value {
    font-size: 0.9rem;
    font-weight: 600;
    color: #111827;
}
</style>

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var originalData = @this.events;
          
            var data = JSON.parse(originalData).map((item) => {
                let newTitle = item.title;
                let isAppointment = item.title.includes('Appointment') || item.title.includes('APPOINTMENT') || item.title.includes('Cita');
                
                if ("{{app()->getLocale()}}" == "es") {
                    newTitle = item.title.includes('Appointment') ? item.title.replace('My Appointment', 'Mi Cita') : item.title.replace('Available', 'Disponible');
                }

                let eventColor = isAppointment ? '#b91c1c' : '#059669';
                return { ...item, title: newTitle, isAppointment: isAppointment, backgroundColor: eventColor, borderColor: eventColor, textColor: '#ffffff', extendedProps: { ...item.extendedProps, isAppointment: isAppointment, originalTitle: newTitle } };
            });
                        
            // Helper: format time string  "08:00:00" → "8:00 AM"
            function formatTime(startStr) {
                if (!startStr || !startStr.includes('T')) return '';
                const timePart = startStr.split('T')[1];
                if (!timePart) return '';
                const [h, m] = timePart.split(':');
                const hour = parseInt(h);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const hour12 = hour % 12 || 12;
                return hour12 + ':' + m + ' ' + ampm;
            }

            var calendar = new Calendar(calendarEl, {
                events: data,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                slotDuration: '00:30:00',
                defaultTimedEventDuration: '00:30:00',

                // ===== CUSTOM EVENT RENDERING =====
                eventContent: function(arg) {
                    const isAppt = arg.event.extendedProps.isAppointment;
                    const timeStr = formatTime(arg.event.startStr);

                    if (isAppt) {
                        // Appointment chip — red, bold, with calendar icon
                        const wrapper = document.createElement('div');
                        wrapper.className = 'fc-event-appt';
                        wrapper.innerHTML =
                            '<span class="fc-event-appt__icon">📅</span>' +
                            '<div class="fc-event-appt__body">' +
                                '<span class="fc-event-appt__time">' + timeStr + '</span>' +
                                '<span class="fc-event-appt__title">' + arg.event.title + '</span>' +
                            '</div>';
                        return { domNodes: [wrapper] };
                    } else {
                        // Available slot chip — green, elegant pill style
                        const wrapper = document.createElement('div');
                        wrapper.className = 'fc-event-avail';
                        wrapper.innerHTML =
                            '<span class="fc-event-avail__dot"></span>' +
                            '<span class="fc-event-avail__time">' + timeStr + '</span>' +
                            '<span class="fc-event-avail__label">Disponible</span>' +
                            '<span class="fc-event-avail__arrow">+</span>';
                        return { domNodes: [wrapper] };
                    }
                },

                dateClick(info) {
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
                                var eventAdd = { title: 'Available', start: date };
                                @this.addevent(eventAdd);
                            } else {
                                alert('Date and Time Is Required');
                            }
                        }
                    }
                },
                eventClick: function(info) {
                    if (info.event.title.includes("Appointment") || info.event.title.includes("APPOINTMENT") || info.event.title.includes("Cita") || info.event.title.includes("CITA")) {
                        @this.showAppointment(info.event.id);
                        setTimeout(function() { $('#show-appointment-button').click(); }, 200);
                    } else {
                        @this.updateSelectedDate(info.event.id);
                        setTimeout(function() { $('#add-appointment-button').click(); }, 200);
                    }
                },
                editable: true,
                selectable: true,
                displayEventTime: false,
                droppable: true,
                drop: function(info) {
                    if (checkbox && checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                eventDrop: (info) => { @this.eventDrop(info.event, info.oldEvent) },
                loading: function(isLoading) {
                    if (!isLoading) {
                        this.getEvents().forEach(function(e) {
                            if (e.source === null) { e.remove(); }
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
                    title: eventTitle,
                    start: eventStart,
                    backgroundColor: '#059669',
                    borderColor: '#059669',
                    textColor: '#ffffff'
                };
                calendar.addEvent(event);
            });

            @this.on('eventRemoved', function(eventId) {
                var event = calendar.getEventById(eventId);
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

                var appointment = {
                    doctorId: data[1],
                    medical_concerns: document.getElementById('appointment-reason').value,
                    assessment_type: document.getElementById('assessment-type').value,
                    date: data[2],
                    time: data[3]
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
