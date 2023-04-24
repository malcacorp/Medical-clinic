<div>
    <div class="row justify-content-center my-5">
        <div class="col-md-12">
            <x-slot name="header">
                <h2 class="ms-4 h3">
                    {{ __('Schedule') }}
                </h2>
            </x-slot>
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
</div>

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
                slotDuration: '01:00:00', //  1 hour interval
                dateClick(info) {
                    if (info.dateStr.length <= 10) {
                        var start = prompt('Ingrese una hora en la que estará disponible:', '08:00:00');
                        var date = new Date(info.dateStr + 'T' + start);
                    } else {
                        var date = new Date(info.dateStr);
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
                            alert('Great. Now, update your database...');
                        } else {
                            alert('Date and Time Is Required');
                        }
                    }
                },
                eventClick: function(info) {
                    if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
                        @this.removeEvent(info.event.id);
                        calendar.getEventById(info.event.id).remove();
                        // @this.emit('refreshCalendar');
                        // Livewire.emit('eliminarEvento', );
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

            @this.on('eventAdded', function(eventId, eventTitle, eventStart) {
                var event = {
                    id: eventId,
                    title: eventTitle,
                    start: eventStart,
                };
                calendar.addEvent(event);
            });
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush
