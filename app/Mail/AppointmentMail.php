<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contact, $appointment;
    private $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $appointment, $template)
    {
        $this->contact = $contact;
        $this->appointment = $appointment;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tamplate = $this->template;
        $subject= $tamplate->subject;
        $body = $tamplate->value;
        $key = ['%7B', '%7D'];
        $value = ['{', '}'];
        $body = str_replace($key, $value, $body);

        $key = ['{CONTACT_NAME}','{APPOINTMENT_DATE}','http://{APPOINTMENT_URL}','{APPOINTMENT_URL}','{EMAIL_SIGNATURE}'];
        $value = [$this->contact->name,formatDate($this->appointment->date),route('appointment.show', $this->appointment->id),route('appointment.show', $this->appointment->id),config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
