<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowToEmailsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('email_templates')->insert([

            [
                'name' => 'Upcoming Date Reminder',
                'type' => 'upcoming_date_reminder',
                'subject' => 'Upcoming Date Reminder',
                'value' => <<<'EOD'
                           <table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
    <tbody>
    <tr style="vertical-align:top;" valign="top">
        <td style="vertical-align:top;" valign="top">

            <div style="background-color:#415094;">
                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">


                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                            <div class="col_cont" style="width:100%;">

                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">


                                    <a href="#">
                                        <img border="0" class="center fixedwidth" src="http://infixlive.com/advtestnew/public/uploads/settings/logo.png" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                    </a>


                                </div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div style="background-color:#415094;">
                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">


                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                            <div class="col_cont" style="width:100%;">

                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">

                                    <img border="0" class="center autowidth" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGF00Oi-zJNU_EvYGueBVz_sqXmFjk8pxNtg&amp;usqp=CAU" style="text-decoration:none;height:auto;border:0;max-width:541px;" width="541" alt="images?q=tbn:ANd9GcRGF00Oi-zJNU_EvYGueBVz_sqXmFjk8pxNtg&amp;usqp=CAU">


                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div style="background-color:#7c32ff;">
                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">


                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                            <div class="col_cont" style="width:100%;">

                                <table cellpadding="0" cellspacing="0" style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;" width="100%">
                                    <tbody>
                                    <tr style="vertical-align:top;" valign="top">
                                        <td align="center" style="vertical-align:top;padding-bottom:5px;padding-left:0px;padding-right:0px;padding-top:25px;text-align:center;width:100%;" valign="top" width="100%">
                                            </td></tr></tbody></table><h1 style="text-align:center;"><font color="#555555" face="Arial">Upcoming Date Reminder</font></h1><h1 style="text-align:center;"><font color="#555555" face="Arial"><br></font></h1><p>Hello {CLIENT_NAME},</p><p><a href="http://advocate.test/%7BCASE_URL%7D" target="_blank" rel="noreferrer noopener">{CASE_NAME}</a> next hearing date is {CASE_DATE}.</p><p><br></p><p><br></p><p><br></p>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div style="background-color:#7c32ff;">
                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">


                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                            <div class="col_cont" style="width:100%;">


                                <div style="line-height:1.2;padding:30px 5px 5px;">
                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;">
                                        <p style="margin:0px;line-height:1.2;text-align:center;">
                                            <span style="color:rgb(255,255,255);font-family:Arial;">© 2021 Infix Advocate | </span><span style="background-color:transparent;text-align:left;font-size:12px;"><font color="#ffffff">89/2 Panthapath, Dhaka 1215, Bangladesh</font></span></p></div></div>


                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div style="background-color:#7c32ff;">
                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">


                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                            <div class="col_cont" style="width:100%;">

                                <table cellpadding="0" cellspacing="0" style="table-layout:fixed;vertical-align:top;border-spacing:0;border-collapse:collapse;" width="100%">
                                    <tbody>
                                    <tr style="vertical-align:top;" valign="top">
                                        <td align="center" style="vertical-align:top;padding-top:5px;padding-right:0px;padding-bottom:5px;padding-left:0px;text-align:center;" valign="top">


                                        </td>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                    <tr style="vertical-align:top;height:40px;" valign="top">
                                        <td align="center" style="vertical-align:top;text-align:center;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:6px;" valign="top"></td>
                                        <td style="font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:15px;color:#9d9d9d;vertical-align:middle;" valign="middle"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>
EOD
                ,
                'available_variable' => '{USER_NAME},{EMAIL_SIGNATURE},{START_DATE},{END_DATE},{LEAVE_REASONE},{APPROVED_BY}',
                'status' => true
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emails_templates', function (Blueprint $table) {
            //
        });
    }
}
