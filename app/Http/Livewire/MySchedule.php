<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Livewire\Component;

class MySchedule extends Component
{
    public $mondayStart, $mondayEnd, $schedule_id;
    public $data = [
        'Monday' => ["start" => '', "end" => ''],
        'Tuesday' => ["start" => '', "end" => ''],
        'Wednesday' => ["start" => '', "end" => ''],
        'Thursday' => ["start" => '', "end" => ''],
        'Friday' => ["start" => '', "end" => ''],
        'Saturday' => ["start" => '', "end" => ''],
        'Sunday' => ["start" => '', "end" => ''],
    ];

    public function mount(){
      $user = auth()->user();
        $employee = Employee::where('user_id', $user->id)->first();
        $exists = $employee !== null;
        if($exists){
          $old_schedules = Schedule::where('employee_id', $employee->id)->get();
          foreach($old_schedules as $data){
            // print($data['start']);
            // print($data['day']);
            $this->data[$data['day']] = ["start" => $data['start'], "end" => $data['end'] ];
          }
          $this->render();
        }
    }
    public function render()
    {   
        // dd( $this->data);
        return view('livewire.myschedule.my-schedule');
    }

    public function store(){
      // print($data);
      $user = auth()->user();
      $employee = Employee::where('user_id', $user->id)->first();
      $exists = $employee !== null;
      if($exists){
        $old_schedules = Schedule::where('employee_id', $employee->id)->delete();
        foreach ($this->data as $day => $value) {
          if($value['start'] != '' && $value['end'] != ''){
            $schedule = Schedule::updateOrCreate(['id' => $this->schedule_id], [
                'day' => $day,
                'start' => $value['start'],
                'end' => $value['end'],
            ]);
            $employee->schedules()->save($schedule);
          }
        }
      }


      session()->flash('message', 
          'Schedule Updated Successfully.');
      }

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit()
    {
      $user = auth()->user();
      $employee = Employee::where('user_id', $user->id)->first();
      $exists = $employee !== null;
      if($exists){
        $old_schedules = Schedule::where('employee_id', $employee->id)->get();
        foreach($old_schedules as $schedule => $data){
          print($schedule);
          print($data);
        }
      }
  
      // $this->handleTabs('isOpenUpdate','isOpenList');
    }
}
