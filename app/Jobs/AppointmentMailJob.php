<?php

namespace App\Jobs;

use App\Mail\ContactAppointmentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AppointmentMail;
use Mail;
use Modules\Setting\Model\EmailTemplate;

class AppointmentMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $contact, $appointment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact, $appointment)
    {
        $this->contact = $contact;
        $this->appointment = $appointment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $template = EmailTemplate::where('type', 'appointment')->where('status', 1)->first();

        if ($template){
            Mail::to(config('configs')->where('key', 'email')->first()->value)->send(new AppointmentMail($this->contact, $this->appointment, $template));
        }

        $contact_template = EmailTemplate::where('type', 'appointment_for_contact')->where('status', 1)->first();

        if ($template and $this->contact->email){
            Mail::to($this->contact->email)->send(new ContactAppointmentMail($this->contact, $this->appointment, $contact_template));
        }

    }
}
