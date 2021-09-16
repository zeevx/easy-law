<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class ContactAppointmentMail extends Mailable
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

        $key = ['{CONTACT_NAME}','{APPOINTMENT_DATE}','{EMAIL_SIGNATURE}', '{APP_NAME}'];
        $value = [$this->contact->name, formatDate($this->appointment->date), config('configs')->where('key', 'mail_signature')->first()->value, config('configs')->where('key', 'site_title')->first()->value ];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
