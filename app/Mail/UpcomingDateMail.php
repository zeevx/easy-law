<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class UpcomingDateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $client, $case, $date;
    private $template;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $case, $date, $template)
    {
        $this->client = $client;
        $this->case = $case;
        $this->date = $date;
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
        $key = ['{CLIENT_NAME}','{CASE_NAME}','{CASE_DATE}','{HEARING_TYPE}','http://{CASE_URL}', '{CASE_URL}' ,'{EMAIL_SIGNATURE}'];
        $value = [$this->client->name,$this->case->title, formatDate($this->date->date),
            $this->date->type, route('case.show',$this->case->id), route('case.show',$this->case->id),config('configs')->where('key', 'mail_signature')->first()->value];

        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
