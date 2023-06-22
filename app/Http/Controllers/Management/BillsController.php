<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BillsController extends Controller
{
    public function get_pending_bills()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $payment_status = "UNPAID";

            $pendings = DB::table('advocates')
                ->join('bills', 'bills.profile_id', '=', 'advocates.profile_id')
                ->select('advocates.*', 'bills.*', )
                ->where('bills.payment_status', $payment_status)
                ->orderBy('bills.created_at', 'desc')
                // ->where('bills.profile_id' , 11474)
                ->paginate(10000);
            return view('management.permit_application.bills.pending', [
                'pendings' => $pendings,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
    public function get_paid_bills()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $payment_status = "PAID";

            $pendings = DB::table('advocates')
                ->join('bills', 'bills.profile_id', '=', 'advocates.profile_id')
                ->select('advocates.*', 'bills.*', )
                ->where('bills.payment_status', $payment_status)
                ->orderBy('bills.created_at', 'desc')
                ->paginate(2000);
            return view('management.permit_application.bills.paid', [
                'pendings' => $pendings,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
    public function get_cancelled_bills()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $payment_status = "CANCELLED";

            $pendings = DB::table('advocates')
                ->join('bills', 'bills.profile_id', '=', 'advocates.profile_id')
                ->select('advocates.*', 'bills.*', )
                ->where('bills.payment_status', $payment_status)
                ->orderBy('bills.created_at', 'desc')
                ->paginate(1000);
            return view('management.permit_application.bills.cancelled', [
                'pendings' => $pendings,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
    public function get_expired_bills()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $payment_status = "EXPIRED";

            $pendings = DB::table('advocates')
                ->join('bills', 'bills.profile_id', '=', 'advocates.profile_id')
                ->select('advocates.*', 'bills.*', )
                ->where('bills.payment_status', $payment_status)
                ->orderBy('bills.created_at', 'desc')
                ->paginate(1000);
            return view('management.permit_application.bills.expired', [
                'pendings' => $pendings,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
    public function get_reconcile_bills()
    {

        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $payment_status = "RECONCILE";

            $pendings = DB::table('advocates')
                ->join('bills', 'bills.profile_id', '=', 'advocates.profile_id')
                ->select('advocates.*', 'bills.*', )
                ->where('bills.payment_status', $payment_status)
                ->orderBy('bills.created_at', 'desc')
                ->paginate(1000);
            return view('management.permit_application.bills.reconcile', [
                'pendings' => $pendings,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
     public function get_payments()
    {

        if (Auth::check()) {
            $bills = DB::table('advocates')
                ->join('payments', 'payments.profile_id', '=', 'advocates.profile_id')
                ->select('advocates.*', 'payments.*', )
                ->orderBy('payments.created_at', 'desc')
                ->paginate(1000);
            return view('management.permit_application.bills.payments', [
                'bills' => $bills,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

     public function get_payment()
    {


            // Make a GET request to the external API
            $response = Http::get('https://<gepgIP>:<port>/api/sp/paymentRequest');

            // Extract the XML content from the response
         if ($response->ok()) {
              $xmlData = $response->body();
           }
           // Parse the XML content
            $xml = simplexml_load_string($xmlData);

            $pymtTrxInf = $xml->PymtTrxInf;
            $ctrAccNum = (string) $pymtTrxInf->CtrAccNum;

            $existingBill = Bill::where('control_number', $ctrAccNum)->first();
            $existingPayment = Payment::where('payctrnum', $ctrAccNum)->first();


          // Extract the relevant information from the XML
          if ($existingBill && $existingPayment){
          $profileId = $existingBill->profile_id;
          $pymtTrxInf = $xml->PymtTrxInf;
          $trxId = (string) $pymtTrxInf->TrxId;
          $spCode = (string) $pymtTrxInf->SpCode;
          $payRefId = (string) $pymtTrxInf->PayRefId;
          $billId = (string) $pymtTrxInf->BillId;
          $payCtrNum = (string) $pymtTrxInf->PayCtrNum;
          $billAmt = (float) $pymtTrxInf->BillAmt;
          $paidAmt = (float) $pymtTrxInf->PaidAmt;
          $billPayOpt = (string) $pymtTrxInf->BillPayOpt;
          $ccy = (string) $pymtTrxInf->CCy;
          $trxDtTm = (string) $pymtTrxInf->TrxDtTm;
          $usdPayChnl = (string) $pymtTrxInf->UsdPayChnl;
          $pyrCellNum = (string) $pymtTrxInf->PyrCellNum;
          $pyrName = (string) $pymtTrxInf->PyrName;
          $pyrEmail = (string) $pymtTrxInf->PyrEmail;
          $pspReceiptNumber = (string) $pymtTrxInf->PspReceiptNumber;
          $pspName = (string) $pymtTrxInf->PspName;
          $ctrAccNum = (string) $pymtTrxInf->CtrAccNum;

          
          // Map the data to your model fields and save it to the database
                 $payment = new Payment;
                 $payment->trx_id = $trxId;
                 $payment->sp_code = $spCode;
                 $payment->pay_ref_id = $payRefId;
                 $payment->bill_id = $billId;
                 $payment->pay_ctr_num = $payCtrNum;
                 $payment->bill_amt = $billAmt;
                 $payment->paid_amt = $paidAmt;
                 $payment->bill_pay_opt = $billPayOpt;
                 $payment->ccy = $ccy;
                 $payment->trx_dt_tm = $trxDtTm;
                 $payment->usd_pay_chnl = $usdPayChnl;
                 $payment->pyr_cell_num = $pyrCellNum;
                 $payment->pyr_name = $pyrName;
                 $payment->pyr_email = $pyrEmail;
                 $payment->psp_receipt_number = $pspReceiptNumber;
                 $payment->psp_name = $pspName;
                 $payment->ctr_acc_num = $ctrAccNum;
                 $payment->profile_id =  $profileId;
                 $payment->save();

          }    
          
          // Prepare the GePG Payment Information posting Acknowledgement XML response
          $ackXml = '<gepgPmtSpInfoAck>';
          $ackXml .= '<TrxStsCode>7101</TrxStsCode>';
          $ackXml .= '</gepgPmtSpInfoAck>';

            // Send the XML response back as the acknowledgement
         return response($ackXml, 200)->header('Content-Type', 'text/xml');

    }
}
