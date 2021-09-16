<?php

namespace Modules\EmailtoCL\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\EmailtoCL\Emails\SendMailToCourtMail;
use Modules\Setting\Model\EmailTemplate;

class SendMailToCourtJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $court;
    private $case;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($court, $case)
    {
        $this->court = $court;
        $this->case = $case;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $template =  EmailTemplate::where('type', 'case_email_to_court')->where('status', 1)->first();
        if ($template){
            Mail::to($this->court->email)->send(new SendMailToCourtMail($this->court, $this->case, $template));
        }
    }
}
