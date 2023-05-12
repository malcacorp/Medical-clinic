<?php

namespace App\Http\Livewire;

use Livewire\Component;




class Appointment extends Component
{
  public $doctors = [];
  public $doctorSelected;

  public function render()
    {
        return view('livewire.appointment.appointment');
    }
}
