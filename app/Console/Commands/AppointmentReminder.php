<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Markdown;
use App\Mail\SendMail;
use Twilio\TwiML\Voice\Sms;
use Twilio\Rest\Client;
use Validator;

class AppointmentReminder extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'appointment:reminder';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Send an appointment reminder for tomorrow';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $today = \Carbon\Carbon::now();
    $today->addDay();
    $tomorrow = $today->format('Y-m-d');
    $appointments = Appointment::where("status", "pending")
      ->where("date", $tomorrow);

    foreach ($appointments as $appointment) {
      $message = Markdown::parse(nl2br("Hola, " . $appointment->patient->first_name . ".\n\n Recuerda que tu cita médica con el Dr. (Dra.) " . $appointment->employee->first_name . " " . $appointment->employee->last_name . " será el día " . $appointment->date . " a las " . $appointment->time . ". \n\n Si necesitas cancelar tu cita, puedes hacer click en el enlace abajo. \n\n [Ir a Clinic Software](https://secure.esperanzavalencia.com) "));
      $messageSms = ("Hola, " . $appointment->patient->first_name . ".Recuerda que tu cita médica con el Dr. (Dra.) " . $appointment->employee->first_name . " " . $appointment->employee->last_name . " será el día " . $appointment->date . " a las " . $appointment->time . ".Si necesitas cancelar tu cita, puedes hacer click en el enlace abajo.[Ir a Clinic Software](https://secure.esperanzavalencia.com) ");
      
      $details = [
        'title' => "Recordatorio de Cita Médica",
        'subject' => "Recordatorio de Cita Médica",
        'message' => $message,
      ];

      Mail::to([$appointment->patient->email])->send(new SendMail($details));
       //Sms de Cancelacion
      $sid = ('AC7cbad7cccea30b0a94576ded8f395b1d');
      $token = ('7eecaa2c3c28a915476886d510d78352');
      $client = new Client($sid, $token);
      $number = $appointment->patient->phone_number;
      $client->messages->create(
          $number,
          [
            'from' => ('+18336651638'),
            'body' => $messageSms,
          ]
        );


    }

    \Log::info('El comando AppointmentReminder se ejecutó correctamente.');
    return Command::SUCCESS;
  }
}