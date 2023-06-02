<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Markdown;
use App\Mail\SendMail;

class TodayAppointmentReminder extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'today-appointment:reminder';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Send an appointment reminder for today';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $today = \Carbon\Carbon::now();
    $today->addDay();
    $appointments = Appointment::where("status", "pending")
      ->where("date", $today);

    foreach ($appointments as $appointment) {
      $message = Markdown::parse(nl2br("Hola, " . $appointment->patient->first_name . ".\n\n Recuerda que tu cita médica con el Dr. (Dra.) " . $appointment->employee->first_name . " " . $appointment->employee->last_name . " será el día " . $appointment->date . " a las " . $appointment->time . ". \n\n Si necesitas cancelar tu cita, puedes hacer click en el enlace abajo. \n\n [Ir a Clinic Software](https://malcamedia.com) "));

      $details = [
        'title' => "Recordatorio de Cita Médica",
        'subject' => "Recordatorio de Cita Médica",
        'message' => $message,
      ];

      Mail::to([$appointment->patient->email])->send(new SendMail($details));
    }

    \Log::info('El comando TodayAppointmentReminder se ejecutó correctamente.');
    return Command::SUCCESS;
  }
}