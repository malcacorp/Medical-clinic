<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Console\Command;

class ScheduleCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:creator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create schedule for the next week';

    public $daysOfWeek = [
        'Sunday' => 0,
        'Monday' => 1,
        'Tuesday' => 2,
        'Wednesday' => 3,
        'Thursday' => 4,
        'Friday' => 5,
        'Saturday' => 6,
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schedules = \App\Models\Schedule::all();
        foreach ($schedules as $schedule) {
            $day = $schedule->day;
            $dayNumber = $this->daysOfWeek[$day];

            $intervals = $this->get30MinuteIntervals($schedule->start, $schedule->end);

            foreach ($intervals as $interval) {
                $hour = Carbon::parse($interval)->hour;
                $minute = Carbon::parse($interval)->minute;
                $start = Carbon::now()->addDays($dayNumber)->setTime($hour, $minute)->setTimezone('UTC')->format('Y-m-d\TH:i:s');

                $events = Event::where('start', $start)->get();

                if($events->count() == 0) {
                    $event = Event::create([
                        'title' => 'Available',
                        'start' => $start,
                    ]);
    
                    $schedule->employee->events()->save($event);                
                }
            }
        }

        \Log::info('El comando ScheduleCreator se ejecutó correctamente.');
        return Command::SUCCESS;
    }

    function get30MinuteIntervals($start, $end)
    {
        $intervals = [];
        $start_time = Carbon::createFromFormat('H:i', $start);
        $end_time = Carbon::createFromFormat('H:i', $end);
        $current_time = $start_time;

        while ($current_time < $end_time) {
            if ($current_time->minute === 0 || $current_time->minute === 30) {
                $intervals[] = $current_time->format('H:i');
            }
            $current_time = $current_time->addMinutes(30);
        }

        return $intervals;
    }
}