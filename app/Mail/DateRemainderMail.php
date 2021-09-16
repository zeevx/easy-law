<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Setting\Model\EmailTemplate;

class DateRemainderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    private $template;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task, $template)
    {
        $this->task = $task;
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
        $key = ['{USER_NAME}','{TASK_NAME}','http://{TASK_URL}','{TASK_URL}','{LAST_DATE}','{EMAIL_SIGNATURE}'];
        $value = [$this->task->assignee->name, $this->task->name,route('task.show',$this->task->id),route('task.show',$this->task->id), formatDate($this->task->due_date),
        config('configs')->where('key', 'mail_signature')->first()->value];
        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);
    }
}
