<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;
use Mail;

class TaskAssigneeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $assigneFrom, $task,$case, $assigneTo;
    private $template;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($assigneFrom, $task,$case, $assigneTo, $template)
    {
        $this->assigneFrom = $assigneFrom;
        $this->task = $task;
        $this->case = $case;
        $this->assigneTo = $assigneTo;
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

        $key = ['{ASSIGNED_FROM}','{TASK_NAME}','http://{TASK_URL}','{TASK_URL}','{ASSIGNED_TO}','{DUE_DATE}','{CASE_NAME}','http://{CASE_URL}','{CASE_URL}','{EMAIL_SIGNATURE}'];
        $value = [$this->assigneFrom->name, $this->task->name,route('task.show', $this->task->id),route('task.show', $this->task->id),$this->assigneTo->name,
        formatDate($this->task->due_date),$this->case->title,route('case.show', $this->case->id),route('case.show', $this->case->id),config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);

    }
}
