<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\CaseDateUpdateMail;
use Modules\Setting\Model\EmailTemplate;

class CaseDateUpdateMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $client, $case, $date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $case, $date)
    {
        $this->client = $client;
        $this->case = $case;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $template = EmailTemplate::where('type', 'case_date_change')->where('status', 1)->first();
        if ($template){
            Mail::to($this->client->email)->send(new CaseDateUpdateMail($this->client, $this->case, $this->date, $template));
        }
    }
}
