<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Event;
 
class Schedule extends Component
{
    public $events = '';
    public $title;
    public $info;

    // public function mount($title)
    // {
    //     $this->title = $title;

    // }
 
    public function getevent()
    {       
        $events = Event::select('id','title','start')->get();
 
        return  json_encode($events);
    }
 
    /**
    * Write code on Method
    *
    * 
    */
    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        $event = Event::create($input);

        $this->reset();

        $this->emit('eventAdded', $event->id, $event->title, $event->start );
    }
 
    /**
    * Write code on Method
    *
    * 
    */
    public function eventDrop($event, $oldEvent)
    {
      $eventdata = Event::find($event['id']);
      $eventdata->start = $event['start'];
      $eventdata->save();
    }
    public function removeEvent($id){
      Event::find($id)->delete();

      // Emitir una señal de Livewire para actualizar la interfaz de usuario
      $this->emit('refreshCalendar');
    }
 
    /**
    * Write code on Method
    *
    * 
    */
    public function render()
    {       
        $events = Event::select('id','title','start')->get();
 
        $this->events = json_encode($events);
 
        return view('livewire.schedule.schedule');
    }
}