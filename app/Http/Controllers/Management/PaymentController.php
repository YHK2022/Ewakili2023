<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petitions\Bill;
use Illuminate\Support\Facades\Redirect;
use App\Models\Masterdata\PetitionSession;
use App\Models\Masterdata\Payment;
use App\Models\Masterdata\Coram;
use App\Models\Masterdata\CoramCleMember;
use App\Models\Masterdata\CleMember;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillEmail;
use App\Models\Advocate\Certificate;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\Petition;
use App\Models\Petitions\Firm;
use Illuminate\Support\Carbon;
use App\Models\Advocate\Advocate;
use Illuminate\Support\Facades\DB;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\FirmAddress;
use App\Models\Petitions\PetitionEducation;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\ApplicationApproval;
use DateTime;
use \SimpleXMLElement;
use App\Profile;
use App\User;
use App\Models\Petitions\Application;

class PaymentController extends Controller
{

    public function handleGePGBillSubReqAck(Request $request)
    {
        // Access the received XML data
        $xmlData = $request->getContent();

        // Process the XML data
        // Extract relevant information and perform necessary actions
        // Example: Update the transaction status in your billing system

        // Prepare the response XML for the acknowledgement
        $responseXml = '<gepgBillSubRespAck><TrxStsCode>7101</TrxStsCode></gepgBillSubRespAck>';

        // Return the response XML
        return response($responseXml)->header('Content-Type', 'application/xml');
    }


    public function handleGePGBillSubResp(Request $request)
    {
        // Access the received XML data
        $xmlData = $request->getContent();

        // Process the XML data
        // Extract relevant information and perform necessary actions
        // Example: Update the transaction status and other relevant information in your billing system

        // Extract relevant data from the XML
        $billId = $request->input('BillTrxInf.BillId');
        $trxSts = $request->input('BillTrxInf.TrxSts');
        $payCntrNum = $request->input('BillTrxInf.PayCntrNum');
        $trxStsCode = $request->input('BillTrxInf.TrxStsCode');

        // Prepare the bill data array
        $billData = [
            'bill_id' => $billId,
            'trx_sts' => $trxSts,
            'pay_cntr_num' => $payCntrNum,
            'trx_sts_code' => $trxStsCode,
        ];

        // Check if the bill ID exists in the bills table
        $bill = Bill::where('bill_id', $billId)->first();

        if ($bill) {
            // Update the control number in the bills table
            $bill->pay_cntr_num = $payCntrNum;
            $bill->save();
        }
    // Return a response to acknowledge the receipt of the callback
    return response()->xml('<gepgBillSubRespAck><TrxStsCode>7101</TrxStsCode></gepgBillSubRespAck>');
    }

    

    public function handleGePGBillSubRespAck(Request $request)
    {
        // Access the received XML data
        $xmlData = $request->getContent();

        // Process the XML data
        // Extract relevant information and perform necessary actions
        // Example: Update the transaction status in your billing system

        // Prepare the response XML for the acknowledgement
        $responseXml = '<gepgBillSubRespAck><TrxStsCode>7101</TrxStsCode></gepgBillSubRespAck>';

        // Return the response XML
        return response($responseXml)->header('Content-Type', 'application/xml');
    }

    public function handleGePGPaymentNotification(Request $request)
    {
        // Access the received gepgPmtSpInfo message
        $gepgPmtSpInfo = $request->getContent();

        // Extract relevant data from the gepgPmtSpInfo message
        $trxId = $request->input('PymtTrxInf.TrxId');
        $spCode = $request->input('PymtTrxInf.SpCode');
        $payRefId = $request->input('PymtTrxInf.PayRefId');
        $billId = $request->input('PymtTrxInf.BillId');
        $payCtrNum = $request->input('PymtTrxInf.PayCtrNum');
        $billAmt = $request->input('PymtTrxInf.BillAmt');
        $paidAmt = $request->input('PymtTrxInf.PaidAmt');
        $billPayOpt = $request->input('PymtTrxInf.BillPayOpt');
        $ccy = $request->input('PymtTrxInf.CCy');
        $trxDtTm = $request->input('PymtTrxInf.TrxDtTm');
        $usdPayChnl = $request->input('PymtTrxInf.UsdPayChnl');
        $pyrCellNum = $request->input('PymtTrxInf.PyrCellNum');
        $pyrName = $request->input('PymtTrxInf.PyrName');
        $pyrEmail = $request->input('PymtTrxInf.PyrEmail');
        $pspReceiptNumber = $request->input('PymtTrxInf.PspReceiptNumber');
        $pspName = $request->input('PymtTrxInf.PspName');
        $ctrAccNum = $request->input('PymtTrxInf.CtrAccNum');

        $paymentData = [
            'trx_id' => $trxId,
            'sp_code' => $spCode,
            'pay_ref_id' => $payRefId,
            'bill_id' => $billId,
            'pay_ctr_num' => $payCtrNum,
            'bill_amt' => $billAmt,
            'paid_amt' => $paidAmt,
            'bill_pay_opt' => $billPayOpt,
            'ccy' => $ccy,
            'trx_dt_tm' => $trxDtTm,
            'usd_pay_chnl' => $usdPayChnl,
            'pyr_cell_num' => $pyrCellNum,
            'pyr_name' => $pyrName,
            'pyr_email' => $pyrEmail,
            'psp_receipt_number' => $pspReceiptNumber,
            'psp_name' => $pspName,
            'ctr_acc_num' => $ctrAccNum,
        ];

        Payment::create($paymentData);
        // Return a response if needed

        // Check if the bill_id exists in the bills table
        $bill = Bill::where('bill_id', $billId)->first();

        if ($bill) {
            // Update the payment_status in the bills table
            $bill->payment_status = 'PAID';
            $bill->save();
        }
        return response('OK');
    }

     public function handleGePGPaymentAcknowledgement(Request $request)
    {
        // Access the received XML data
        $xmlData = $request->getContent();

        // Process the XML data
        // Extract relevant information and perform necessary actions
        // Example: Update the acknowledgement status in your billing system

        // Prepare the gepgPmtSpInfoAck response
        $gepgPmtSpInfoAck = '<gepgPmtSpInfoAck><TrxStsCode>7101</TrxStsCode></gepgPmtSpInfoAck>';

        // Return the response XML for the acknowledgement
        return response($gepgPmtSpInfoAck)->header('Content-Type', 'application/xml');
    }
}
