<?php

namespace App\Jobs;

use App\Mail\UpcomingDateMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Modules\Setting\Model\EmailTemplate;

class UpcomingDateMailJob implements ShouldQueue
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
        $template = EmailTemplate::where('type', 'upcoming_date_reminder')->where('status', 1)->first();
        if ($template){
            Mail::to($this->client->email)->send(new UpcomingDateMail($this->client, $this->case, $this->date, $template));
        }
    }
}
