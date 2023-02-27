@extends('template')


@section('content')
@php 
   $rol = App\Models\Persona::where('id',Auth::user()->id)->get('rol');
@endphp
<div id="calendar"></div>
@endsection

@section('scripts')
<script src="{{ asset('public/fullcalendar.js') }}" type="text/javascript" ></script>
<script>
    $('#calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'addEventButton',
    right: 'month,agendaWeek,agendaDay,listWeek'
  },
  defaultDate: '2018-11-16',
  navLinks: true,
  editable: true,
  eventLimit: true,
  events: [
      {
      title: 'Simple static event',
      start: '2020-12-01',
      description: 'Super cool event'
    },
  
    @foreach($citas as $cita)
        @php 
            $paciente= App\Models\Persona::where('id',$cita->paciente_id)->first();
        @endphp
{
    title  : 'Cita Doctor-Paciente :{{ $paciente->nombres }} {{ $paciente->apellidos }}',
    start  : '2020-12-05',
    end    : '2020-12-05',
    url: '{{ route('cita.edit',$cita) }}',
    color: 'yellow',   // an option!
     textColor: 'black' // an option! 

},

    @endforeach

  ],
  customButtons: {
    addEventButton: {
      text: 'Add new event',
      click: function () {
        var dateStr = prompt('Enter date in YYYY-MM-DD format');
        var date = moment(dateStr);

        if (date.isValid()) {
          $('#calendar').fullCalendar('renderEvent', {
            title: 'Dynamic event',
            start: date,
            allDay: true
          });
        } else {
          alert('Invalid Date');
        }

      }
    }
  },
  dayClick: function (date, jsEvent, view) {
    var date = moment(date);

    if (date.isValid()) {
      $('#calendar').fullCalendar('renderEvent', {
        title: 'Dynamic event from date click',
        start: date,
        allDay: true
      });
    } else {
      alert('Invalid');
    }
  },
});
</script>
@endsection

@section('css')
@endsection