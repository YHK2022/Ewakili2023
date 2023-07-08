<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ***** AUTHENTICATION ROUTE STARTS ******//

//****Home Page Routes Start****** //

//Route::get('/', function () {
//    return view('index');
//});
//
//Auth::routes();

Route::get('/', 'HomeController@index');

Route::match(['get', 'post'], '/account/verify/{token}', 'AuthController@verify');
Route::get('login/auto/{token}', [AuthController::class, 'autoLogin'])->name('login.auto');
// Route::get('login/auto/{token}', 'AuthController@autoLogin')->name('login.auto');
Route::post('send-email', 'AuthController@sendEmail')->name('send.email');

// gepg acknowlegment
Route::post('/callback/gepg-bill-sub-req-ack', 'PaymentController@handleGePGBillSubReqAck');
Route::post('/callback/gepg-bill-sub-resp', 'PaymentController@handleGePGBillSubResp');
Route::post('/callback/gepg-bill-sub-resp-ack','PaymentController@handleGePGBillSubRespAck');
Route::post('/callback/gepg-payment-notification', 'PaymentController@handleGePGPaymentNotification');
Route::post('/callback/gepg-payment-acknowledgement', 'PaymentController@handleGePGPaymentAcknowledgement');

//****Authentication Routes Start****** //
Route::group(['prefix' => 'auth'], function() {
    Route::get('/login', 'AuthController@index');
    Route::get('/register', 'AuthController@register');
    Route::get('/dashboard', 'AuthController@get_dashboard');
    Route::get('/advocate-profile', 'AuthController@advocate_profile');
    Route::get('/petitioner-profile', 'AuthController@petitioner_profile');
    Route::get('/temporary-advocate-profile', 'AuthController@temporary_advocate_profile');
    Route::post('/post-login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
    Route::post('/account/advocate', 'AuthController@register_advocate');
    Route::post('/account/attorney', 'AuthController@register_attorney');
    Route::post('/account/litigant', 'AuthController@register_litigant');
    Route::get('/users', 'Users\UserController@get_index');
    Route::post('/users/create', 'AuthController@add_user');
    Route::post('/users/edit/{id}', 'AuthController@edit_user');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/profile', 'AuthController@profile');
    // Route::get('/login/{token}', 'AuthController@autoLogin')->name('login.auto');

    Route::post('/password-verify', 'Authentications\ForgotPasswordController@verify_email');
    Route::post('/password-reset', 'Authentications\ResetPasswordController@reset_response');
});

Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin');

Route::get('advocate-registration', 'AuthController@advocateRegistration');
Route::get('temporary-advocate-registration', 'AuthController@TemporaryadvocateRegistration');

Route::get('attorney-registration', 'AuthController@registration');
Route::get('litigant-registration', 'AuthController@registration');
Route::get('bureau-registration', 'AuthController@registration');


Route::post('advocate-post-registration', 'AuthController@AdvocatePostRegistration');
Route::post('temporary-advocate-post-registration', 'AuthController@TemporaryAdvocatePostRegistration');
Route::post('attorney-post-registration', 'AuthController@postRegistration');
Route::post('litigant-post-registration', 'AuthController@postRegistration');
Route::post('bureau-post-registration', 'AuthController@postRegistration');


Route::post('advocate-post-register', 'AuthController@AdvocatePostRegister');
Route::get('register', 'AuthController@advocateRegister');


//after login process complete
Route::get('dashboard', 'AuthController@dashboard');
Route::get('logout', 'AuthController@logout');

//email verification
Route::get('/user/verify/{token}', 'AuthController@verifyUser');

//Password reset
Route::get('reset-password', 'AuthController@resetPassword');
Route::post('post-reset-password', 'AuthController@postResetPassword');
// Route::get('/user/reset/{token}', 'AuthController@reset');
Route::get('forget-password/{token}', 'AuthController@showResetPasswordForm');
Route::post('forget-password','AuthController@submitResetPasswordForm');


// ****** ENDS *********//

// ***** PETITION FOR ADMISSION ******//
//****Petition Routes Start****** //
Route::group(['prefix' => 'petition'], function() {
    Route::get('/personal-details', 'Advocates\PetitionController@get_personal_detal_index');
    Route::get('/qualifications', 'Advocates\PetitionController@get_qualification_index');
Route::match(['get', 'post'], '/update-qualification/{id}', 'Advocates\PetitionController@update_qualification');

    Route::get('/attachments', 'Advocates\PetitionController@get_attachment_index');
    Route::post('/post-profile', 'Advocates\PetitionController@add_profile');
Route::match(['get', 'post'], '/update-profile/{user_id}', 'Advocates\PetitionController@update_profile');

    Route::post('/post-petition', 'Advocates\PetitionController@add_petition_document');
Route::match(['get', 'post'], '/delete-petition/{id}', 'Advocates\PetitionController@delete_petition');

    Route::post('/post-csee', 'Advocates\PetitionController@add_csee_document');
Route::match(['get', 'post'], '/delete-csee/{id}', 'Advocates\PetitionController@delete_csee');

    Route::post('/post-necta', 'Advocates\PetitionController@add_necta_document');
Route::match(['get', 'post'], '/delete-necta/{id}', 'Advocates\PetitionController@delete_necta');

    Route::post('/post-acsee', 'Advocates\PetitionController@add_acsee_document');
Route::match(['get', 'post'], '/delete-acsee/{id}', 'Advocates\PetitionController@delete_acsee');

    Route::post('/post-nacte', 'Advocates\PetitionController@add_nacte_document');
Route::match(['get', 'post'], '/delete-nacte/{id}', 'Advocates\PetitionController@delete_nacte');

    Route::post('/post-llbcert', 'Advocates\PetitionController@add_llbcert_document');
Route::match(['get', 'post'], '/delete-llbcert/{id}', 'Advocates\PetitionController@delete_llbcert');

    Route::post('/post-llbtrans', 'Advocates\PetitionController@add_llbtrans_document');
Route::match(['get', 'post'], '/delete-llbtrans/{id}', 'Advocates\PetitionController@delete_llbtrans');

    Route::post('/post-tcu', 'Advocates\PetitionController@add_tcu_document');
Route::match(['get', 'post'], '/delete-tcu/{id}', 'Advocates\PetitionController@delete_tcu');

    Route::post('/post-lstcert', 'Advocates\PetitionController@add_lstcert_document');
Route::match(['get', 'post'], '/delete-lstcert/{id}', 'Advocates\PetitionController@delete_lstcert');

    Route::post('/post-lsttrans', 'Advocates\PetitionController@add_lsttrans_document');
Route::match(['get', 'post'], '/delete-lsttrans/{id}', 'Advocates\PetitionController@delete_lsttrans');

    Route::post('/post-pupilage', 'Advocates\PetitionController@add_pupilage_document');
Route::match(['get', 'post'], '/delete-pupilage/{id}', 'Advocates\PetitionController@delete_pupilage');

    Route::post('/post-intenship', 'Advocates\PetitionController@add_intenship_document');
Route::match(['get', 'post'], '/delete-intenship/{id}', 'Advocates\PetitionController@delete_intenship');

    Route::post('/post-empletter', 'Advocates\PetitionController@add_empletter_document');
Route::match(['get', 'post'], '/delete-empletter/{id}', 'Advocates\PetitionController@delete_empletter');

    Route::post('/post-deedpoll', 'Advocates\PetitionController@add_deedpoll_document');
Route::match(['get', 'post'], '/delete-deedpoll/{id}', 'Advocates\PetitionController@delete_deedpall');

    Route::post('/post-birthcert', 'Advocates\PetitionController@add_birthcert_document');
Route::match(['get', 'post'], '/delete-birthcert/{id}', 'Advocates\PetitionController@delete_birthcert');

    Route::post('/post-charcert', 'Advocates\PetitionController@add_charcert_document');
Route::match(['get', 'post'], '/delete-charcert/{id}', 'Advocates\PetitionController@delete_charcert');

    Route::post('/post-attachments', 'Advocates\PetitionController@submit_attachments');
    Route::post('/post-qualification', 'Advocates\PetitionController@add_qualification');
    Route::post('/post-picture', 'Advocates\PetitionController@add_profile_picture');

    Route::get('/llb', 'Advocates\PetitionController@get_llb_index');
Route::get('/venue', 'Advocates\PetitionController@get_venue_index');

    Route::get('/lst', 'Advocates\PetitionController@get_lst_index');
    Route::get('/experience', 'Advocates\PetitionController@get_experience_index');
    Route::get('/firm', 'Advocates\PetitionController@get_firm_index');
    Route::get('/finish', 'Advocates\PetitionController@get_finish_index');

    Route::post('/post-llb', 'Advocates\PetitionController@add_llb');
Route::post('/post-venue', 'Advocates\PetitionController@add_venue');

    Route::post('/post-lst', 'Advocates\PetitionController@add_lst');
Route::match(['get', 'post'], '/update-lst/{id}', 'Advocates\PetitionController@update_lst');
Route::match(['get', 'post'], '/update-llb/{id}', 'Advocates\PetitionController@update_llb');
Route::match(['get', 'post'], '/update-venue/{id}', 'Advocates\PetitionController@update_venue');

    Route::post('/post-experience', 'Advocates\PetitionController@add_experience');
Route::match(['get', 'post'], '/update-experience/{id}', 'Advocates\PetitionController@update_experience');

    Route::post('/complete-petition', 'Advocates\PetitionController@complete_petition');

    Route::get('/search-firm','Advocates\PetitionController@search_firm');

    Route::get('/add-firm', 'Advocates\PetitionController@get_add_firm_index');
    Route::post('/post-firm', 'Advocates\PetitionController@add_firm');
    Route::match(['get', 'post'], '/request-firm/{id}', 'Advocates\PetitionController@add_firm_request');
    Route::get('/firm-confirmation', 'Advocates\PetitionController@get_firm_confirmation');
    Route::match(['get', 'post'], '/post-firm-confirmation', 'Advocates\PetitionController@post_firm_confirmation');
    Route::post('/confirm-firm', 'Advocates\PetitionController@confirm_firm');

    Route::match(['get', 'post'], '/submit-application', 'Advocates\PetitionController@submit_application');
    Route::match(['get', 'post'], '/resubmit-application', 'Advocates\PetitionController@resubmit_application');


});
//****Petition Routes Ends****** //
// ****** ENDS *********//



// ***** PETITION FOR ADMISSION ******//
//****Petition Routes Start****** //
Route::group(['prefix' => 'temporary'], function() {
    Route::get('/personal-detail', 'Advocates\TemporaryAdmissionsController@get_personal_detal_index');
    Route::get('/application-form', 'Advocates\TemporaryAdmissionsController@get_qualification_index');
Route::match(['get', 'post'], '/update-application-form/{id}', 'Advocates\TemporaryAdmissionsController@update_qualification');

    Route::get('/temporary-attachment', 'Advocates\TemporaryAdmissionsController@get_attachment_index');
    Route::post('/post-profiles', 'Advocates\TemporaryAdmissionsController@add_profile');
Route::match(['get', 'post'], '/update-profiles/{user_id}', 'Advocates\TemporaryAdmissionsController@update_profile');

    Route::post('/post-petition', 'Advocates\TemporaryAdmissionsController@add_petition_document');
Route::match(['get', 'post'], '/delete-petition/{id}', 'Advocates\TemporaryAdmissionsController@delete_petition');

    Route::post('/post-admission-certificate', 'Advocates\TemporaryAdmissionsController@add_admission_document');
Route::match(['get', 'post'], '/delete-admission-certificate/{id}', 'Advocates\TemporaryAdmissionsController@delete_admission');

    Route::post('/post-practising', 'Advocates\TemporaryAdmissionsController@add_practising_document');
Route::match(['get', 'post'], '/delete-practising/{id}', 'Advocates\TemporaryAdmissionsController@delete_practising');

    Route::post('/post-notary', 'Advocates\TemporaryAdmissionsController@add_notary_document');
Route::match(['get', 'post'], '/delete-notary/{id}', 'Advocates\TemporaryAdmissionsController@delete_notary');

    Route::post('/post-letter', 'Advocates\TemporaryAdmissionsController@add_letter_document');
Route::match(['get', 'post'], '/delete-letter/{id}', 'Advocates\TemporaryAdmissionsController@delete_letter');

    Route::post('/post-ordinary', 'Advocates\TemporaryAdmissionsController@add_ordinary_document');
Route::match(['get', 'post'], '/delete-ordinary/{id}', 'Advocates\TemporaryAdmissionsController@delete_ordinary');

    Route::post('/post-advanced', 'Advocates\TemporaryAdmissionsController@add_advanced_document');
Route::match(['get', 'post'], '/delete-advanced/{id}', 'Advocates\TemporaryAdmissionsController@delete_advanced');

    Route::post('/post-bachelor', 'Advocates\TemporaryAdmissionsController@add_bachelor_document');
Route::match(['get', 'post'], '/delete-bachelor/{id}', 'Advocates\TemporaryAdmissionsController@delete_bachelor');

    Route::post('/post-work', 'Advocates\TemporaryAdmissionsController@add_work_document');
Route::match(['get', 'post'], '/delete-work/{id}', 'Advocates\TemporaryAdmissionsController@delete_work');

   
   
    Route::post('/post-attachments', 'Advocates\TemporaryAdmissionsController@submit_attachments');
    Route::post('/post-qualification', 'Advocates\TemporaryAdmissionsController@add_qualification');
    Route::post('/post-picture', 'Advocates\TemporaryAdmissionsController@add_profile_picture');

   
    Route::get('/complete', 'Advocates\TemporaryAdmissionsController@get_finish_index');
    Route::get('/my-applications', 'Advocates\TemporaryAdmissionsController@get_application_index');



    Route::post('/complete-petition', 'Advocates\PetitionController@complete_petition');

    Route::match(['get', 'post'], '/submit-applications', 'Advocates\TemporaryAdmissionsController@submit_applications');
    Route::match(['get', 'post'], '/resubmit-application', 'Advocates\PetitionController@resubmit_application');


});
//****Petition Routes Ends****** //
// ****** ENDS *********//


// ***** PERMIT APPLICATION ******//
//****pertmit application Routes Start****** //
Route::group(['prefix' => 'permit'], function () {
    Route::get('/name-change/under-review', 'Management\PermitController@get_index');
    Route::match(['get', 'post'], '/name-change/view/{id}', 'Management\PermitController@view_profile');
    Route::match(['get', 'post'], '/name-change/under-review/edit/{id}', 'Management\PermitController@edit_front');
    Route::get('/name-change/rhc', 'Management\PermitController@get_rhc');
    Route::match(['get', 'post'], '/name-change/rhc/view/{id}', 'Management\PermitController@view_rhc');
    Route::match(['get', 'post'], '/name-change/rhc/edit/{id}', 'Management\PermitController@edit_rhc');
    Route::get('/name-change/jk', 'Management\PermitController@get_jk');
    Route::match(['get', 'post'], '/name-change/jk/view/{id}', 'Management\PermitController@view_jk');
    Route::match(['get', 'post'], '/name-change/jk/edit/{id}', 'Management\PermitController@edit_jk');

    Route::get('/late-renewal/under-review', 'Management\PermitController@get_renewal_index');
    Route::match(['get', 'post'], '/late-renewal/view/{id}', 'Management\PermitController@view_renewal_profile');
    Route::match(['get', 'post'], '/late-renewal/under-review/edit/{id}', 'Management\PermitController@edit_renewal_front');
    Route::get('/late-renewal/rhc', 'Management\PermitController@get_renewal_rhc');
    Route::match(['get', 'post'], '/late-renewal/rhc/view/{id}', 'Management\PermitController@view_renewal_rhc');
    Route::match(['get', 'post'], '/late-renewal/rhc/edit/{id}', 'Management\PermitController@edit_renewal_rhc');
    Route::get('/late-renewal/cj', 'Management\PermitController@get_renewal_cj');
    Route::match(['get', 'post'], '/late-renewal/cj/view/{id}', 'Management\PermitController@view_renewal_cj');
    Route::match(['get', 'post'], '/late-renewal/cj/edit/{id}', 'Management\PermitController@edit_renewal_cj');

    Route::get('/resume-practising/under-review', 'Management\PermitController@get_resume_index');
    Route::match(['get', 'post'], '/resume-practising/view/{id}', 'Management\PermitController@view_resume_profile');
    Route::match(['get', 'post'], '/resume-practising/under-review/edit/{id}', 'Management\PermitController@edit_resume_front');
    Route::get('/resume-practising/rhc', 'Management\PermitController@get_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/view/{id}', 'Management\PermitController@view_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/edit/{id}', 'Management\PermitController@edit_resume_rhc');
    Route::get('/resume-practising/cj', 'Management\PermitController@get_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/view/{id}', 'Management\PermitController@view_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/edit/{id}', 'Management\PermitController@edit_resume_cj');

    Route::get('/suspend/under-review', 'Management\PermitController@get_suspend_index');
    Route::match(['get', 'post'], '/suspend/view/{id}', 'Management\PermitController@view_suspend_profile');
    Route::match(['get', 'post'], '/suspend/under-review/edit/{id}', 'Management\PermitController@edit_suspend_front');
    Route::get('/suspend/rhc', 'Management\PermitController@get_suspend_rhc');
    Route::match(['get', 'post'], '/suspend/rhc/view/{id}', 'Management\PermitController@view_suspend_rhc');
    Route::match(['get', 'post'], '/suspend/rhc/edit/{id}', 'Management\PermitController@edit_suspend_rhc');
    Route::get('/suspend/cj', 'Management\PermitController@get_suspend_cj');
    Route::match(['get', 'post'], '/suspend/cj/view/{id}', 'Management\PermitController@view_suspend_cj');
    Route::match(['get', 'post'], '/suspend/cj/edit/{id}', 'Management\PermitController@edit_suspend_cj');

    Route::get('/non-practising/under-review', 'Management\PermitController@get_practising_index');
    Route::match(['get', 'post'], '/non-practising/view/{id}', 'Management\PermitController@view_practising_profile');
    Route::match(['get', 'post'], '/non-practising/under-review/edit/{id}', 'Management\PermitController@edit_practising_front');
    Route::get('/non-practising/rhc', 'Management\PermitController@get_practising_rhc');
    Route::match(['get', 'post'], '/non-practising/rhc/view/{id}', 'Management\PermitController@view_practising_rhc');
    Route::match(['get', 'post'], '/non-practising/rhc/edit/{id}', 'Management\PermitController@edit_practising_rhc');
    Route::get('/non-practising/cj', 'Management\PermitController@get_practising_cj');
    Route::match(['get', 'post'], '/non-practising/cj/view/{id}', 'Management\PermitController@view_practising_cj');
    Route::match(['get', 'post'], '/non-practising/cj/edit/{id}', 'Management\PermitController@edit_practising_cj');

    Route::get('/retire-practising/under-review', 'Management\PermitController@get_retire_index');
    Route::match(['get', 'post'], '/retire-practising/view/{id}', 'Management\PermitController@view_retire_profile');
    Route::match(['get', 'post'], '/retire-practising/under-review/edit/{id}', 'Management\PermitController@edit_retire_front');
    Route::get('/retire-practising/rhc', 'Management\PermitController@get_retire_rhc');
    Route::match(['get', 'post'], '/retire-practising/rhc/view/{id}', 'Management\PermitController@view_retire_rhc');
    Route::match(['get', 'post'], '/retire-practising/rhc/edit/{id}', 'Management\PermitController@edit_retire_rhc');
    Route::get('/retire-practising/cj', 'Management\PermitController@get_retire_cj');
    Route::match(['get', 'post'], '/retire-practising/cj/view/{id}', 'Management\PermitController@view_retire_cj');
    Route::match(['get', 'post'], '/retire-practising/cj/edit/{id}', 'Management\PermitController@edit_retire_cj');

    Route::get('/non-profit/under-review', 'Management\PermitController@get_profit_index');
    Route::match(['get', 'post'], '/non-profit/view/{id}', 'Management\PermitController@view_profit_profile');
    Route::match(['get', 'post'], '/non-profit/under-review/edit/{id}', 'Management\PermitController@edit_profit_front');
    Route::get('/non-profit/rhc', 'Management\PermitController@get_profit_rhc');
    Route::match(['get', 'post'], '/non-profit/rhc/view/{id}', 'Management\PermitController@view_profit_rhc');
    Route::match(['get', 'post'], '/non-profit/rhc/edit/{id}', 'Management\PermitController@edit_profit_rhc');
    Route::get('/non-profit/cj', 'Management\PermitController@get_profit_cj');
    Route::match(['get', 'post'], '/non-profit/cj/view/{id}', 'Management\PermitController@view_profit_cj');
    Route::match(['get', 'post'], '/non-profit/cj/edit/{id}', 'Management\PermitController@edit_profit_cj');

    Route::get('/temporary-admission/under-review', 'Management\PermitController@get_admission_index');
    Route::get('/temporary-admission/rhc', 'Management\PermitController@get_admission_rhc');
    Route::get('/temporary-admission/cj', 'Management\PermitController@get_admission_cj');

    Route::get('/trace-application/petition-application', 'Management\ApplicationTrackingController@get_petition_application');
    Route::get('/trace-application/permit-request', 'Management\ApplicationTrackingController@get_permit_request');
    Route::get('/trace-application/temporary-admission', 'Management\ApplicationTrackingController@get_temporary_admission');
    Route::get('/trace-application/resume-petition', 'Management\ApplicationTrackingController@get_resume_petition');

    Route::get('/bills/pending', 'Management\BillsController@get_pending_bills');
    Route::get('/bills/paid', 'Management\BillsController@get_paid_bills');
    Route::get('/bills/cancelled', 'Management\BillsController@get_cancelled_bills');
    Route::get('/bills/expired', 'Management\BillsController@get_expired_bills');
    Route::get('/bills/reconciliation', 'Management\BillsController@get_reconcile_bills');
    Route::get('/bills/payments', 'Management\BillsController@get_payments');


});
//****Petition Routes Ends****** //
// ****** ENDS *********//

// ***** RESUME PETITION APPLICATION ******//
//****resume petition application Routes Start****** //
Route::group(['prefix' => 'resume'], function () {
    Route::get('resume-petition/rhc', 'Management\ResumeController@get_index');
    Route::match(['get', 'post'], '/name-change/view/{id}', 'Management\ResumeController@view_profile');
    Route::match(['get', 'post'], '/name-change/under-review/edit/{id}', 'Management\ResumeController@edit_front');
    Route::get('resume-petition/cle-approval', 'Management\ResumeController@get_cle');
    Route::match(['get', 'post'], '/name-change/rhc/view/{id}', 'Management\ResumeController@view_rhc');
    Route::match(['get', 'post'], '/name-change/rhc/edit/{id}', 'Management\ResumeController@edit_rhc');
    Route::get('resume-petition/cj-approval', 'Management\ResumeController@get_cj');
    Route::match(['get', 'post'], '/name-change/jk/view/{id}', 'Management\ResumeController@view_jk');
    Route::match(['get', 'post'], '/name-change/jk/edit/{id}', 'Management\ResumeController@edit_jk');

    Route::get('/resume-practising/under-review', 'Management\ResumeController@get_resume_index');
    Route::match(['get', 'post'], '/resume-practising/view/{id}', 'Management\ResumeController@view_resume_profile');
    Route::match(['get', 'post'], '/resume-practising/under-review/edit/{id}', 'Management\ResumeController@edit_resume_front');
    Route::get('/resume-practising/rhc', 'Management\ResumeController@get_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/view/{id}', 'Management\ResumeController@view_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/edit/{id}', 'Management\ResumeController@edit_resume_rhc');
    Route::get('/resume-practising/cj', 'Management\ResumeController@get_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/view/{id}', 'Management\ResumeController@view_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/edit/{id}', 'Management\ResumeController@edit_resume_cj');

    Route::get('/suspend/under-review', 'Management\ResumeController@get_suspend_index');
    Route::match(['get', 'post'], '/suspend/view/{id}', 'Management\ResumeController@view_suspend_profile');
    Route::match(['get', 'post'], '/suspend/under-review/edit/{id}', 'Management\ResumeController@edit_suspend_front');
    Route::get('/suspend/rhc', 'Management\ResumeController@get_suspend_rhc');
    Route::match(['get', 'post'], '/suspend/rhc/view/{id}', 'Management\ResumeController@view_suspend_rhc');
    Route::match(['get', 'post'], '/suspend/rhc/edit/{id}', 'Management\ResumeController@edit_suspend_rhc');
    Route::get('/suspend/cj', 'Management\ResumeController@get_suspend_cj');
    Route::match(['get', 'post'], '/suspend/cj/view/{id}', 'Management\ResumeController@view_suspend_cj');
    Route::match(['get', 'post'], '/suspend/cj/edit/{id}', 'Management\ResumeController@edit_suspend_cj');

});

// ***** RESUME PETITION APPLICATION ******//
//****resume petition application Routes Start****** //
Route::group(['prefix' => 'resume'], function () {
    Route::get('resume-petition/rhc', 'Management\ResumeController@get_index');
    Route::match(['get', 'post'], '/name-change/view/{id}', 'Management\ResumeController@view_profile');
    Route::match(['get', 'post'], '/name-change/under-review/edit/{id}', 'Management\ResumeController@edit_front');
    Route::get('resume-petition/cle-approval', 'Management\ResumeController@get_cle');
    Route::match(['get', 'post'], '/name-change/rhc/view/{id}', 'Management\ResumeController@view_rhc');
    Route::match(['get', 'post'], '/name-change/rhc/edit/{id}', 'Management\ResumeController@edit_rhc');
    Route::get('resume-petition/cj-approval', 'Management\ResumeController@get_cj');
    Route::match(['get', 'post'], '/name-change/jk/view/{id}', 'Management\ResumeController@view_jk');
    Route::match(['get', 'post'], '/name-change/jk/edit/{id}', 'Management\ResumeController@edit_jk');

    Route::get('/resume-practising/under-review', 'Management\ResumeController@get_resume_index');
    Route::match(['get', 'post'], '/resume-practising/view/{id}', 'Management\ResumeController@view_resume_profile');
    Route::match(['get', 'post'], '/resume-practising/under-review/edit/{id}', 'Management\ResumeController@edit_resume_front');
    Route::get('/resume-practising/rhc', 'Management\ResumeController@get_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/view/{id}', 'Management\ResumeController@view_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/edit/{id}', 'Management\ResumeController@edit_resume_rhc');
    Route::get('/resume-practising/cj', 'Management\ResumeController@get_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/view/{id}', 'Management\ResumeController@view_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/edit/{id}', 'Management\ResumeController@edit_resume_cj');

    Route::get('/suspend/under-review', 'Management\ResumeController@get_suspend_index');
    Route::match(['get', 'post'], '/suspend/view/{id}', 'Management\ResumeController@view_suspend_profile');
    Route::match(['get', 'post'], '/suspend/under-review/edit/{id}', 'Management\ResumeController@edit_suspend_front');
    Route::get('/suspend/rhc', 'Management\ResumeController@get_suspend_rhc');
    Route::match(['get', 'post'], '/suspend/rhc/view/{id}', 'Management\ResumeController@view_suspend_rhc');
    Route::match(['get', 'post'], '/suspend/rhc/edit/{id}', 'Management\ResumeController@edit_suspend_rhc');
    Route::get('/suspend/cj', 'Management\ResumeController@get_suspend_cj');
    Route::match(['get', 'post'], '/suspend/cj/view/{id}', 'Management\ResumeController@view_suspend_cj');
    Route::match(['get', 'post'], '/suspend/cj/edit/{id}', 'Management\ResumeController@edit_suspend_cj');

});

// ***** RESUME PETITION APPLICATION ******//
//****resume petition application Routes Start****** //
Route::group(['prefix' => 'miscellaneous'], function () {
    Route::get('/abandoned', 'Management\MiscellaneousController@get_index');
    Route::match(['get', 'post'], '/name-change/view/{id}', 'Management\MiscellaneousController@view_profile');
    Route::match(['get', 'post'], '/name-change/under-review/edit/{id}', 'Management\MiscellaneousController@edit_front');
    Route::get('/postponed', 'Management\MiscellaneousController@get_postponed');
    Route::match(['get', 'post'], '/name-change/rhc/view/{id}', 'Management\MiscellaneousController@view_rhc');
    Route::match(['get', 'post'], '/name-change/rhc/edit/{id}', 'Management\MiscellaneousController@edit_rhc');
    Route::get('/objected', 'Management\MiscellaneousController@get_objected');
    Route::match(['get', 'post'], '/name-change/jk/view/{id}', 'Management\MiscellaneousController@view_jk');
    Route::match(['get', 'post'], '/name-change/jk/edit/{id}', 'Management\MiscellaneousController@edit_jk');

    Route::get('/deferred', 'Management\MiscellaneousController@get_deferred');
    Route::match(['get', 'post'], '/resume-practising/view/{id}', 'Management\MiscellaneousController@view_resume_profile');
    Route::match(['get', 'post'], '/resume-practising/under-review/edit/{id}', 'Management\MiscellaneousController@edit_resume_front');
    Route::get('/resume-practising/rhc', 'Management\MiscellaneousController@get_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/view/{id}', 'Management\MiscellaneousController@view_resume_rhc');
    Route::match(['get', 'post'], '/resume-practising/rhc/edit/{id}', 'Management\MiscellaneousController@edit_resume_rhc');
    Route::get('/resume-practising/cj', 'Management\MiscellaneousController@get_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/view/{id}', 'Management\MiscellaneousController@view_resume_cj');
    Route::match(['get', 'post'], '/resume-practising/cj/edit/{id}', 'Management\MiscellaneousController@edit_resume_cj');

});

//***** ADVOCATE ACTIVITIES ROUTES ******** //

//***** Certificate Renewals ***********//

Route::group(['prefix' => 'renewal'], function(){
    Route::get('/', 'Advocates\RenewalController@get_index');
Route::get('/autocomplete', 'Advocates\RenewalController@autocomplete');
Route::get('/search-roll', 'Advocates\RenewalController@search_adv');
Route::get('/searchRolls', 'Advocates\RenewalController@searchRolls');
Route::get('/autocomplete-search', 'Advocates\RenewalController@search')->name('autocomplete.search');
Route::match(['get', 'post'], '/request_control_number/{$id}', 'Advocates\RenewalController@request_control_number');
Route::match(['get', 'post'], '/request-control-number/{id}', 'Advocates\RenewalController@control_number_request');


    // TLS compliance check request and response
    Route::match(['get', 'post'], '/tls-check/{id}', 'Advocates\TlsCheckController@compliance_check');
    Route::match(['get', 'post'],'tls-compliance-response', 'Advocates\TlsCheckController@compliance_responce');
Route::match(['get', 'post'], '/tax-check/{id}', 'Advocates\TlsCheckController@tax_clearance_check');
// Route::match(['get', 'post'], '/search', 'Advocates\RenawalController@search');

});

//***** Requests Permit ***********//

Route::group(['prefix' => 'request'], function(){
    Route::get('/', 'Advocates\RequestController@get_index');

Route::match(['get', 'post'], '/change-name-request', 'Advocates\RequestController@change_name_request');
Route::match(['get', 'post'], '/non-practising-request', 'Advocates\RequestController@non_practising_request');
Route::match(['get', 'post'], '/suspend-request', 'Advocates\RequestController@suspend_request');
Route::match(['get', 'post'], '/non-profit-request', 'Advocates\RequestController@non_profit_request');
Route::match(['get', 'post'], '/resume-practising-request', 'Advocates\RequestController@resume_practising_request');
Route::match(['get', 'post'], '/retire-practising-request', 'Advocates\RequestController@retire_practising_request');


    // Renew Out of Time
Route::match(['get', 'post'], '/out-of-time', 'Advocates\RequestController@out_of_time_request');

    // Renew Out of Time with accumulation without current penalty
    Route::match(['get', 'post'], '/out-of-time-without-penalty/{id}', 'Advocates\RequestController@outoftime_without_penalty_request');
Route::match(['get', 'post'], '/out-of-time', 'Advocates\RequestController@out_of_time_request');

});


//***** My Applications ***********//

Route::group(['prefix' => 'my-application'], function(){
    Route::get('/', 'Advocates\MyApplicationController@get_index');
});

//***** My Certificates ***********//

Route::group(['prefix' => 'my-certificate'], function(){
    Route::get('/', 'Advocates\MyCertificateController@get_index');
    Route::match(['get', 'post'], '/view/{id}', 'Advocates\MyCertificateController@view_certificate');
Route::match(['get', 'post'], '/notary/{id}', 'Advocates\MyCertificateController@view_notary_certificate');



});

//***** Firm & Workplace ***********//

Route::group(['prefix' => 'firm'], function(){
    Route::get('/', 'Advocates\FirmController@get_index');
    Route::match(['get', 'post'], '/view/{id}', 'Advocates\FirmController@view_firm');
});

//***** Bills & Payments ***********//

Route::group(['prefix' => 'bill'], function(){
    Route::get('/bill', 'Advocates\BillController@get_bill_index');
    Route::get('/payment', 'Advocates\BillController@get_payment_index');


});

//***** User Management ***********//

Route::group(['prefix' => 'user'], function(){
Route::post('/changepass/{id}', 'Advocates\UserController@changePassword');
Route::post('/update_profile/{id}', 'Advocates\UserController@profileUpdate');
Route::get('/profile', 'Advocates\UserController@profile');

});



// ***** MANAGEMENT SECTION ******//
//****user Management Routes Start****** //
Route::group(['prefix' => 'user-management'], function() {

    //--User permission ----
    Route::get('/permission', 'Management\PermissionController@get_index');
    Route::post('/permission/add', 'Management\PermissionController@add_permission');
    Route::match(['get', 'post'], '/permission/edit/{id}', 'Management\PermissionController@edit_permission');
    Route::match(['get', 'post'], '/permission/delete/{id}', 'Management\PermissionController@delete_permission');

    //--User roles ----
    Route::get('/role', 'Management\RoleController@get_index');
    Route::post('/role/add', 'Management\RoleController@add_role');
    Route::match(['get', 'post'], '/role/edit/{id}', 'Management\RoleController@edit_role');
    Route::match(['get', 'post'], '/role/delete/{id}', 'Management\RoleController@delete_role');
    Route::get('/role/permission/{id}', 'Management\RoleController@permission');
    // Route::post('/role/set_permission', 'Management\RoleController@setPermission');
    Route::post('/role/setPermission', 'Management\RoleController@setPermission');





    Route::get('/user', 'Management\UserController@get_index');
    Route::post('/user/add', 'Management\UserController@add_user');
    Route::match(['get', 'post'], '/user/edit/{id}', 'Management\UserController@edit_user');

    Route::match(['get', 'post'], '/user/delete/{id}', 'Management\UserController@delete_user');
    
    // Route::get('/profile/{id}', 'Management\UserController@profile');
Route::get('/user/list', 'Management\UserController@getUsers');

    Route::post('/update_profile/{id}', 'Management\UserController@profileUpdate');
Route::post('/changepass/{id}', 'Management\UserController@changePassword');

    Route::get('/cle-members', 'Management\UserController@get_cle');
    Route::get('/legal-professional', 'Management\UserController@get_lp');


    Route::get('/advocate-commettee', 'Management\AdvocateCommetteeController@get_index');

    Route::get('/profile', 'Management\UserController@profile');

    Route::match(['get', 'post'], '/submit-application', 'Advocates\PetitionController@submit_application');


});
//****User Management Routes Ends****** //


//****Master data Routes Start****** //
Route::group(['prefix' => 'settings'], function() {

    //--Categories ----
    Route::get('/advocate-category', 'Management\AdvocateCategoryController@get_index');
    Route::post('/advocate-category/add', 'Management\AdvocateCategoryController@add_category');
    Route::match(['get', 'post'], '/advocate-category/edit/{id}', 'Management\AdvocateCategoryController@edit_category');
    Route::match(['get', 'post'], '/advocate-category/delete/{id}', 'Management\AdvocateCategoryController@delete_category');

    //--Application/Request Types ----
    Route::get('/request-types', 'Management\RequestTypeController@get_index');
    Route::post('/request-types/add', 'Management\RequestTypeController@add_request');
    Route::match(['get', 'post'], '/request-types/edit/{id}', 'Management\RequestTypeController@edit_request');
    Route::match(['get', 'post'], '/request-types/delete/{id}', 'Management\RequestTypeController@delete_request');

   //--Countries ----
    Route::get('/country', 'Locations\CountryController@get_index');
    Route::post('/country/add', 'Locations\CountryController@add_country');
    Route::match(['get', 'post'], '/country/edit/{id}', 'Locations\CountryController@edit_country');
    Route::match(['get', 'post'], '/country/delete/{id}', 'Locations\CountryController@delete_country');

//--Fee Type ----
Route::get('/fee-types', 'Management\FeeTypeController@get_index');
Route::post('/fee-types/add', 'Management\FeeTypeController@add_feetypes');
Route::match(['get', 'post'], '/fee-types/edit/{id}', 'Management\FeeTypeController@edit_feetypes');
Route::match(['get', 'post'], '/fee-types/delete/{id}', 'Management\FeeTypeController@delete_feetypes');

//--Fee ----
Route::get('/fees', 'Management\FeeController@get_index');
Route::post('/fees/add', 'Management\FeeController@add_fees');
Route::match(['get', 'post'], '/fees/edit/{id}', 'Management\FeeController@edit_fees');
Route::match(['get', 'post'], '/fees/delete/{id}', 'Management\FeeController@delete_fees');

    //--Attachments ----
Route::get('/attachment', 'Management\AttachmentTypeController@get_index');
Route::post('/attachment/add', 'Management\AttachmentTypeController@add_attachment');
Route::match(['get', 'post'], '/attachment/edit/{id}', 'Management\AttachmentTypeController@edit_attachment');
Route::match(['get', 'post'], '/attachment/delete/{id}', 'Management\AttachmentTypeController@delete_attachment');

//--Qualificatins ----
Route::get('/qualifications', 'Management\QualificationController@get_index');
Route::post('/qualifications/add', 'Management\QualificationController@add_qualifications');
Route::match(['get', 'post'], '/qualifications/edit/{id}', 'Management\QualificationController@edit_qualifications');
Route::match(['get', 'post'], '/qualifications/delete/{id}', 'Management\QualificationController@delete_qualificatins');

   //--Appearance ----
Route::get('/appearance', 'Management\AppearanceVenueController@get_index');
Route::post('/appearance/add', 'Management\AppearanceVenueController@add_appearance');
Route::match(['get', 'post'], '/appearance/edit/{id}', 'Management\AppearanceVenueController@edit_appearance');
Route::match(['get', 'post'], '/appearance/delete/{id}', 'Management\AppearanceVenueController@delete_appearance');

    //--Regions ----
    Route::get('/region', 'Locations\RegionController@get_index');
    Route::post('/region/add', 'Locations\RegionController@add_region');
    Route::match(['get', 'post'], '/region/edit/{id}', 'Locations\RegionController@edit_region');
    Route::match(['get', 'post'], '/region/delete/{id}', 'Locations\RegionController@delete_region');

    //--Districts ----
    Route::get('/district', 'Locations\DistrictController@get_index');
    Route::post('/district/add', 'Locations\DistrictController@add_district');
    Route::match(['get', 'post'], '/district/edit/{id}', 'Locations\DistrictController@edit_district');
    Route::match(['get', 'post'], '/district/delete/{id}', 'Locations\DistrictController@delete_district');

    //--Petition Sessions ----
    Route::get('/petition-session', 'Management\PetitionSessionController@get_index');
    Route::post('/petition-session/add', 'Management\PetitionSessionController@add_session');
    // Route::get('/coram/cle/members/{id}', 'Management\PetitionSessionController@coramCleMembers')->name('coram_cle_members');
    Route::get('/petition-session/appearance_members/{id}', 'Management\PetitionSessionController@appearanceMembers')->name('appearance_members');
    Route::get('/petition-session/coram_cle_members/{id}', 'Management\PetitionSessionController@coramCleMembers')->name('coram_cle_members');
    Route::match(['get', 'post'], '/petition-session/view/{id}', 'Management\PetitionSessionController@view_session');
    Route::match(['get', 'post'], '/petition-session/profile-view/{id}', 'Management\PetitionSessionController@profile_view_session');
    Route::match(['get', 'post'], '/petition-session/view/edit/{id}', 'Management\PetitionSessionController@change_venue');


Route::get('/appearance', 'Management\PetitionSessionController@get_appearance');
Route::post('/appearance/add', 'Management\PetitionSessionController@add_appearance');
Route::match(['get', 'post'], '/appearance/view/{id}', 'Management\PetitionSessionController@view_appearance');

    Route::match(['get', 'post'], '/petition-session/edit/{id}', 'Management\PetitionSessionController@edit_session');
    Route::match(['get', 'post'], '/petition-session/delete/{id}', 'Management\PetitionSessionController@delete_session');

    //--Renewal Batches ----
    Route::get('/batch', 'Management\RenewalBatchController@get_index');
    Route::post('/batch/add', 'Management\RenewalBatchController@add_batch');
    Route::match(['get', 'post'], '/batch/edit/{id}', 'Management\RenewalBatchController@edit_batch');
    Route::match(['get', 'post'], '/batch/delete/{id}', 'Management\RenewalBatchController@delete_batch');

    //--Appearance Venue ----
    Route::get('/venue', 'Management\VenueController@get_index');
    Route::post('/venue/add', 'Management\VenueController@add_venue');
    Route::match(['get', 'post'], '/venue/edit/{id}', 'Management\VenueController@edit_venue');
    Route::match(['get', 'post'], '/venue/delete/{id}', 'Management\VenueController@delete_venue');

    //--Action Stages ----
    Route::get('/stage', 'Management\StageController@get_index');
    Route::post('/stage/add', 'Management\StageController@add_stage');
    Route::match(['get', 'post'], '/stage/edit/{id}', 'Management\StageController@edit_stage');
    Route::match(['get', 'post'], '/stage/delete/{id}', 'Management\StageController@delete_stage');



Route::get('/system/logs', 'Management\SystemLogsController@logs_index');

});
//****Master data Routes Ends****** //


//****Advocate Profile Routes Start****** //
Route::group(['prefix' => 'advocate'], function() {

    //--Roll of advocates ----
    Route::get('/roll', 'Advocates\AdvocateController@search');
    Route::get('/search', 'Advocates\AdvocateController@search');
    Route::match(['get', 'post'], '/view/{id}', 'Advocates\AdvocateController@view_profile');


});
//****Advocate Profile Routes Ends****** //



//****Temporary Advocate Applications Routes Start****** //
Route::group(['prefix' => 'temporary-admission'], function() {

   
//--RHC Review ----
Route::get('/rhc-review', 'Management\TemporaryAdmissionController@get_rhc');
Route::match(['get', 'post'], '/rhc/view/{id}', 'Management\TemporaryAdmissionController@view_rhc');
Route::match(['get', 'post'], '/rhc-view/edit/{id}', 'Management\TemporaryAdmissionController@edit_rhc');


//--CJ Review ----
Route::get('/cj-review', 'Management\TemporaryAdmissionController@get_cj');
Route::match(['get', 'post'], '/cj/view/{id}', 'Management\TemporaryAdmissionController@view_cj');
Route::match(['get', 'post'], '/cj-review/admit/{id}', 'Management\TemporaryAdmissionController@admit');
Route::match(['get', 'post'], '/cj-review/enroll', 'Management\TemporaryAdmissionController@enroll');

Route::match(['get', 'post'], '/cj-appearance/edit/{id}', 'Management\PetitionApplicationUnderReviewController@edit_cj');

Route::get('/new-applicant', 'Management\PetitionApplicationUnderReviewController@new_applicant');
Route::match(['get', 'post'], '/new-applicant/view/{id}', 'Management\PetitionApplicationUnderReviewController@view_applicant');
Route::get('/legal-objections', 'Management\LegalProfessionalViewController@legal_objections');
Route::match(['get', 'post'], '/legal-objections/view/{id}', 'Management\LegalProfessionalViewController@view_lp');
Route::match(['get', 'post'], '/legal-objections/edit/{id}', 'Management\LegalProfessionalViewController@edit_lp');
});


//****Petition Applications Routes Start****** //
Route::group(['prefix' => 'petition'], function() {

    //--Under Review ----
Route::get('/under-review', 'Management\PetitionApplicationUnderReviewController@get_index');
Route::match(['get', 'post'], '/view/{id}', 'Management\PetitionApplicationUnderReviewController@view_profile');
Route::match(['get', 'post'], '/under-review/edit/{id}', 'Management\PetitionApplicationUnderReviewController@edit_front');

//--RHC Review ----
Route::get('/rhc-review', 'Management\PetitionApplicationUnderReviewController@get_rhc');
Route::match(['get', 'post'], '/rhc/view/{id}', 'Management\PetitionApplicationUnderReviewController@view_rhc');
Route::match(['get', 'post'], '/rhc-view/edit/{id}', 'Management\PetitionApplicationUnderReviewController@edit_rhc');

//--CLE Review ----
Route::get('/cle-inspection', 'Management\PetitionApplicationUnderReviewController@get_cle');
Route::match(['get', 'post'], '/cle/view/{id}', 'Management\PetitionApplicationUnderReviewController@view_cle');
Route::match(['get', 'post'], '/cle-inspection/edit/{id}', 'Management\PetitionApplicationUnderReviewController@edit_cle');

//--CJ Review ----
Route::get('/cj-appearance', 'Management\PetitionApplicationUnderReviewController@get_cj');
Route::match(['get', 'post'], '/cj/view/{id}', 'Management\PetitionApplicationUnderReviewController@view_cj');
Route::match(['get', 'post'], '/cj-appearance/admit/{id}', 'Management\PetitionApplicationUnderReviewController@admit');
Route::match(['get', 'post'], '/cj-appearance/enroll', 'Management\PetitionApplicationUnderReviewController@enroll');

Route::match(['get', 'post'], '/cj-appearance/edit/{id}', 'Management\PetitionApplicationUnderReviewController@edit_cj');

Route::get('/new-applicant', 'Management\PetitionApplicationUnderReviewController@new_applicant');
Route::match(['get', 'post'], '/new-applicant/view/{id}', 'Management\PetitionApplicationUnderReviewController@view_applicant');
Route::get('/legal-objections', 'Management\LegalProfessionalViewController@legal_objections');
Route::match(['get', 'post'], '/legal-objections/view/{id}', 'Management\LegalProfessionalViewController@view_lp');
Route::match(['get', 'post'], '/legal-objections/edit/{id}', 'Management\LegalProfessionalViewController@edit_lp');
});

//****Petition Report Routes Start****** //
Route::group(['prefix' => 'report'], function() {

    //-- Petition ----
    Route::get('/petition', 'Reports\ReportController@petition');
    Route::get('/advocate', 'Reports\ReportController@advocate');
    Route::get('/permit', 'Reports\ReportController@permit');
    Route::get('/revenue', 'Reports\ReportController@revenue')->name('revenue');
    Route::get('/advocatesearch', 'Reports\ReportController@revenue');
    Route::match(['get', 'post'], '/view/{id}', 'Management\PetitionApplicationController@view_profile');
});




//****Petition Applications Routes Ends****** //


// ****** ENDS *********//


// *****ADVOCATES & PUBLIC ACTIVITIES ******//
//****AdvocateCategory Search Routes Start****** //
Route::group(['prefix' => 'public'], function() {

    Route::get('/search-advocate','Advocates\AdvocateController@search_advocate');
    Route::match(['get', 'post'], '/view-profile/{id}', 'Advocates\AdvocateController@public_view_profile');


});
//****Petition Routes Ends****** //
// ****** ENDS *********//

Route::get('/popup-message/{total_all_fees}/{control_number}', function ($total_all_fees, $control_number) {
    return view('popup-message', compact('total_all_fees', 'control_number'));
})->name('popup-message');
