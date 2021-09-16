<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Model\EmailTemplate;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("subject")->nullable();
            $table->longtext("value")->nullable();
            $table->text('available_variable')->nullable();
            $table->boolean("status")->nullable()->default(true);
            $table->timestamps();
        });


        DB::table('email_templates')->insert([

            [
                'name' => 'Welcome Mail',
                'type' => 'welcome_mail',
                'subject' => 'Welcome Mail',
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
                                            <h1 style="color:rgb(85,85,85);font-family:Arial;">Welcome to {APP_NAME}</h1>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div style="line-height:1.8;padding:20px 15px;">
                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                        <p style="text-align:center;margin:10px 0px 30px;line-height:1.929;"><font color="#737487" face="Arial, Helvetica Neue, Helvetica, sans-serif"><span style="font-size:18px;">Hello {USER_NAME} ,</span></font></p><p style="margin-right:0px;margin-left:0px;line-height:1.8;text-align:center;"><span style="font-size:18px;">A Account has been created to {APP_NAME}.</span></p><p style="margin-right:0px;margin-left:0px;line-height:1.8;text-align:center;"><span style="font-size:18px;"><br></span></p></div></div>

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
EOD,
                'available_variable' => '{APP_NAME},{USER_NAME},{APP_NAME}',
                'status' => true
            ],

            [
                'name' => 'Signup Mail',
                'type' => 'sign_up_email',
                'subject' => 'Sign up Email',
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
                                            <h1 style="color:rgb(85,85,85);font-family:Arial;">Sign Up Email</h1>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div style="line-height:1.8;padding:20px 15px;">
                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                        <p style="text-align:center;margin:10px 0px 30px;line-height:1.929;"><font color="#737487" face="Arial, Helvetica Neue, Helvetica, sans-serif"><span style="font-size:18px;">Hello {USER_NAME} ,</span></font></p><p style="margin-right:0px;margin-left:0px;line-height:1.8;text-align:center;"><span style="font-size:18px;">A Account has been created to {APP_NAME}.</span></p><p style="margin-right:0px;margin-left:0px;line-height:1.8;text-align:center;"><span style="font-size:18px;">Your Login Username is: {USER_NAME}</span></p><p style="margin-right:0px;margin-left:0px;line-height:1.8;text-align:center;"><span style="font-size:18px;">Your Login Password Is: {PASSWORD}</span></p><p style="margin-right:0px;margin-left:0px;line-height:1.8;text-align:center;"><br></p></div></div>

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
                'available_variable' => '{APP_NAME},{USER_NAME},{APP_NAME},{PASSWORD}',
                'status' => true
            ],

            [
                'name' => 'Task Assign',
                'type' => 'task_assign',
                'subject' => 'Task Assign',
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
                                            <h1 style="line-height:120%;text-align:center;margin-top:0px;margin-bottom:0px;"><font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif"><span style="font-size:36px;">{ASSIGNED_FROM} Assigned A Task To You</span></font><br></h1>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div style="line-height:1.8;padding:20px 15px;">
                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                        <p style="text-align:left;margin:0px;line-height:1.8;"><span style="color:rgb(115,116,135);font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:18px;">A Task </span><a href="%7BTASK_URL%7D" target="_blank" style="color:rgb(115,116,135);font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;background-color:rgb(255,255,255);text-align:left;" rel="noreferrer noopener">{TASK_NAME}</a><span style="color:rgb(115,116,135);font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:16px;"> is assigned to you which due date is set on {DUE_DATE} and related to case: </span><a href="%7BCASE_URL%7D" target="_blank" style="background-color:rgb(255,255,255);font-size:16px;" rel="noreferrer noopener">{CASE_NAME}</a></p><p style="text-align:left;margin:0px;line-height:1.8;"><br></p></div></div>

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


                                <div style="color:#262b30;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;color:#262b30;">
                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;"><span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">© 2021 Infix Advocate | </span><span style="background-color:transparent;text-align:left;"><font color="#ffffff">89/2 Panthapath, Dhaka 1215, Bangladesh</font></span><br></p></div></div>


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
                'available_variable' => '{ASSIGNED_FROM},{TASK_NAME},{ASSIGNED_TO},{DUE_DATE},{CASE_NAME},{CASE_URL},{EMAIL_SIGNATURE}',
                'status' => true
            ],
            [
                'name' => 'Task Completed',
                'type' => 'task_complete',
                'subject' => 'Task Complete',
                'value' => <<<'EOD'
                <table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">

EOD
                ,
                'available_variable' => '{EMAIL_SIGNATURE},{USER_NAME},{TASK_NAME},{TASK_URL},{CASE_NAME},{CASE_URL}',
                'status' => true
            ],
            [
                'name' => 'Task Date Reminder',
                'type' => 'due_date_remider',
                'subject' => 'Due date remider',
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
                                            </td></tr></tbody></table><h1 style="text-align:center;"><font color="#555555" face="Arial">Task Due Date Reminder</font></h1><div style="line-height:1.8;padding:20px 15px;"><div class="txtTinyMce-wrapper" style="line-height:1.8;"><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;">Hello {USER_NAME},</p><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;">You have assigned in <a href="http://advocate.test/%7BTASK_URL%7D" target="_blank" rel="noreferrer noopener">{TASK_NAME}</a>, which due date is nearby. </p><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;">The last date of this task is {LAST_DATE}</p></div></div>

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
                'available_variable' => '{EMAIL_SIGNATURE},{USER_NAME},{TASK_NAME},{LAST_DATE},{TASK_URL}',
                'status' => true
            ],
            [
                'name' => 'Password Reset',
                'type' => 'password_reset_template',
                'subject' => 'Password reset template',
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
                                            </td></tr></tbody></table><h1 style="line-height:120%;text-align:center;margin-bottom:0px;"><font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif"><span style="font-size:36px;">Password Reset</span></font></h1><div style="line-height:1.8;padding:20px 15px;"><div class="txtTinyMce-wrapper" style="line-height:1.8;"><h1>Hello!</h1><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">You are receiving this email because we received a password reset request for your account.</p><p style="text-align:center;margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);"> <a href="%7BRESET_LINK%7D" target="_blank" style="font-size:12px;line-height:40px;background:#7c32ff;color:#fff;letter-spacing:1px;font-weight:500;padding:19px 52px;text-align:center;text-transform:uppercase;border:0;text-decoration:none;font-family:Arial, 'Helvetica Neue', Helvetica;" rel="noreferrer noopener">RESET LINK</a></p><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">This password reset link will expire in 60 minutes.</p><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">If you did not request a password reset, no further action is required.</p><p style="text-align:left;margin:0px;line-height:1.8;"><br></p></div></div>

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


                                <div style="color:#262b30;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;color:#262b30;">
                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;"><span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">© 2021 Infix Advocate | </span><span style="background-color:transparent;text-align:left;"><font color="#ffffff">89/2 Panthapath, Dhaka 1215, Bangladesh</font></span><br></p></div></div>


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
                'available_variable' => '{RESET_LINK},{APP_NAME}',
            'status' => true
                        ],

                        [
                            'name' => 'Appointment',
                            'type' => 'appointment',
                            'subject' => 'Appointment',
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
                                            </td></tr></tbody></table><h1 style="line-height:120%;text-align:center;margin-bottom:0px;"><font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif"><span style="font-size:36px;">Appointment</span></font></h1><h1 style="line-height:120%;text-align:center;margin-bottom:0px;"><br></h1><div style="line-height:1.8;padding:20px 15px;"><div class="txtTinyMce-wrapper" style="line-height:1.8;"><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;">Hello ,</p><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);"><span style="color:rgb(130,139,178);">Here are new appointment with {CONTACT_NAME}  at  {APPOINTMENT_DATE}</span></p><p style="text-align:center;margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);"> <a href="%7BAPPOINTMENT_URL%7D" target="_blank" style="font-size:12px;line-height:40px;background:#7c32ff;color:#fff;letter-spacing:1px;font-weight:500;padding:19px 52px;text-align:center;text-transform:uppercase;border:0;text-decoration:none;font-family:Arial, 'Helvetica Neue', Helvetica;" rel="noreferrer noopener">View Details</a></p></div></div>

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


                                <div style="color:#262b30;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;color:#262b30;">
                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;"><span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">© 2021 Infix Advocate | </span><span style="background-color:transparent;text-align:left;"><font color="#ffffff">89/2 Panthapath, Dhaka 1215, Bangladesh</font></span><br></p></div></div>


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
                            'available_variable' => '{CONTACT_NAME},{APPOINTMENT_DATE},{EMAIL_SIGNATURE}',
                            'status' => true
                        ],
                        [
                            'name' => 'Case Date Changed',
                            'type' => 'case_date_change',
                            'subject' => 'Case Date change',
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
                                            </td></tr></tbody></table><h1 style="text-align:center;"><font color="#555555" face="Arial">Case Date Change</font></h1><h1 style="text-align:center;"><br></h1><p>Hello {CLIENT_NAME},</p><p><a href="http://advocate.test/%7BCASE_URL%7D" target="_blank" rel="noreferrer noopener">{CASE_NAME}</a> hearing date has chanced to {CASE_DATE}.</p><p><br></p><p><br></p><p><br></p>

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
        Schema::dropIfExists('email_templates');
    }
}
