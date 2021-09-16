<?php

namespace Modules\EmailtoCL\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\EmailtoCL\Emails\SendMailToLawyerMail;
use Modules\Setting\Model\EmailTemplate;

class SendMailToLawyerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $lawyer;
    private $case;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lawyer, $case)
    {
        $this->lawyer = $lawyer;
        $this->case = $case;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $template =  EmailTemplate::where('type', 'case_email_to_lawyer')->where('status', 1)->first();
        if ($template){
            Mail::to($this->lawyer->email)->send(new SendMailToLawyerMail($this->lawyer, $this->case, $template));
        }
    }
}
