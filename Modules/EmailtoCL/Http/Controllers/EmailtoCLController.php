<?php

namespace Modules\EmailtoCL\Http\Controllers;

use App\Models\Cases;
use App\Models\Lawyer;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Routing\Controller;
use Modules\EmailtoCL\Jobs\SendMailToCourtJob;
use Modules\EmailtoCL\Jobs\SendMailToLawyerJob;

class EmailtoCLController extends Controller
{
    public function sendMailToCourt($case_id)
    {
        $case = Cases::with('court')->find($case_id);
        $court = $case->court;

        if (!$case){
            Toastr::error(__('case.Case Not Found'));
            return redirect()->route('case.show', $case_id);
        }

        if (!$court){
            Toastr::error(__('court.Court Not Found'));
            return redirect()->route('case.show', $case_id);
        }

        if ($court->email){
            try{
                dispatch(new SendMailToCourtJob($court, $case));
                Toastr::success(__('case.Mail Sent Successfully'));
                return redirect()->route('case.show', $case_id);
            } catch (\Exception $e){
                Toastr::error($e->getMessage());
                return redirect()->route('case.show',$case_id);
            }
        }
        Toastr::error(__('court.Court has no email address'));
        return redirect()->route('case.show', $case_id);
    }

    public function sendMailToLawyer($case_id, $lawyer_id)
    {
        $case = Cases::find($case_id);
        $lawyer = Lawyer::find($lawyer_id);

        if (!$case){
            Toastr::error(__('case.Case Not Found'));
            return redirect()->route('case.show', $case_id);
        }

        if (!$lawyer){
            Toastr::error(__('lawyer.Lawyer Not Found'));
            return redirect()->route('case.show', $case_id);
        }

        if ($lawyer->email){
            try{
                dispatch(new SendMailToLawyerJob($lawyer, $case));
                Toastr::success(__('case.Mail Sent Successfully'));
                return redirect()->route('case.show', $case_id);
            } catch (\Exception $e){
                Toastr::error($e->getMessage());
                return redirect()->route('case.show',$case_id);
            }
        }
        Toastr::error(__('lawyer.Lawyer has no email address'));
        return redirect()->route('case.show', $case_id);
    }
}
