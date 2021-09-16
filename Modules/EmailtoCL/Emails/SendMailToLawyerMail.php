<?php

namespace Modules\EmailtoCL\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailToLawyerMail extends Mailable
{
    use Queueable, SerializesModels;
    public $lawyer;
    private $template;
    private $case;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lawyer, $case, $template)
    {
        $this->lawyer = $lawyer;
        $this->template = $template;
        $this->case = $case;
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

        $key = [
            '{LAWYER_NAME}',
            '{CASE_TITLE}',
            '{APP_NAME}',
            '{CASE_CATEGORY}',
            '{CASE_NO}',
            '{CASE_FILE_NO}',
            '{CASE_ACTS}',
            '{PLAINTIFF}',
            '{ACCUESED}',
            '{ON_BEHALF_OF}',
            '{COURT}',
            '{REFERENCE_NAME}',
            '{REFERENCE_MOBILE}',
            '{LAWYER}',
            '{CASE_STAGE}',
            '{CASE_CHARGE}',
            '{RECEIVING_DATE}',
            '{FILING_DATE}',
            '{HEARING_DATE}',
            '{JUDGEMENT_DATE}',
        ];

        $value = [
            $this->lawyer->name,
            $this->case->title,
            config('configs')->where('key', 'site_title')->first()->value,
            @$this->case->case_category->name,
            $this->case->case_no,
            $this->case->file_no,
            $this->processActs(),
            @$this->case->plaintiff_client->name,
            @$this->case->opposite_client->name,
            @$this->case->client_category->name,
            @$this->case->court->name,
            $this->case->ref_name,
            $this->case->ref_mobile,
            $this->processLawyers(),
            @$this->case->case_stage->name,
            amountFormat($this->case->case_charge),
            formatDate($this->case->receiving_date),
            formatDate($this->case->filling_date),
            formatDate($this->case->hearing_date),
            formatDate($this->case->judgement_date),

        ];

        $body = str_replace($key, $value, $body);


        return $this->view('mail_body')->with(["body" => $body])->subject($subject);

    }

    private function processLawyers(){
        $lawyers = $this->case->lawyers;
        $lawyer = '';
        $i = 0;
        $count = $lawyers->count();

        foreach ($lawyers as $db_lawyer) {
            if ($i and $i < $count){
                $lawyer .= ', ';
            }
            $lawyer .= $db_lawyer->name. ' ('.$db_lawyer->mobile_no.')';
            $i++;
        }

        return $lawyer;
    }

    private function processActs(){
        $acts = $this->case->acts;
        $act = '';
        $i = 0;
        $count = $acts->count();

        foreach ($acts as $db_act) {
            if ($i and $i < $count){
                $act .= ', ';
            }
            $act .= $db_act->act->name;
            $i++;
        }

        return $act;
    }
}
