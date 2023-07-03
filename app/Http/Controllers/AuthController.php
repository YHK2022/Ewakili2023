<?php

namespace App\Http\Controllers;

use App\Models\Advocate\Advocate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator,Redirect,Response;
Use App\User;
Use App\VerifyUser;
use App\Mail\VerifyMail;
use App\Mail\resetPassword;
use App\Profile;
use App\Models\Masterdata\Appearance;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Petitions\PetitionForm;
use App\Models\Petitions\Document;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationMove;
use App\Models\Petitions\AttachmentMove;
use App\Models\Petitions\Qualification;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\LlbCollege;
use App\Models\Petitions\LstCollege;
use App\Models\Petitions\Firm;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Session;
use App\Models\Masterdata\PetitionSession;
use Illuminate\Support\Facades\Http;

// use Mail;

class AuthController extends Controller
{
    /**
     * view index page
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function advocateRegistration()
    {
        return view('auth.advocate-register');
    }

     public function advocateRegister()
    {
        return view('auth.register');
    }

    /**
     * view reset password
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    /**
     * view send password reset code
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function postResetPassword(Request $request)
    {
        request()->validate([
        'email' => 'required',
        ]);

        // check if email exists
    
        $checkEmail = User::where("email", $request->input('email'))->first();
          if ($checkEmail) {
          $token = Str::random(64);
          $expiresAt = Carbon::now()->addMinutes(15);
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token,
              // 'expires_at' => $expiresAt, 
              'created_at' => Carbon::now()
            ]);
          // Mail::send('emails.password-reset', ['token' => $token], function($message) use($request){
          //     $message->to($request->email);
          //     $message->subject('Reset Password');
          // });
              Mail::to($checkEmail->email)->send(new \App\Mail\ResetPassword($token));
            return Redirect::to("login")->withErrors(' please check your email To Reset your Account');


          }else{
            return redirect()->back()->withErrors('Email does not exist!');
          }

    }

      public function showResetPasswordForm($token) { 
         return view('auth.forget-password', ['token' => $token]);

      }
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
          $user = User::where('email', $request->email)
          ->update(['password' => Hash::make($request->password)]);
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
          return  Redirect::to("login")->with('message', 'Your password has been changed!');

      }

    /**
     * Login function
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
        // Authentication passed... check if verified

        $verified = User::where("email", $request->input('email'))->first();
        $value = $verified->verified;

          if ($value > 0) {
            //check user role
            $user = Auth::user();
            $role = $user->getRoleNames()->first();

            //check user if is a petitioner and or advocate

            $petitioner = Auth::user()->petitioner;
            $advocate = Auth::user()->is_advocate;
            // dd($advocate , $petitioner);

            if($petitioner > 0){
                if($advocate > 0){
                    return redirect()->intended('auth/advocate-profile');
                }else{
                    return redirect()->intended('auth/petitioner-profile');
                }
            }else{
              return redirect()->intended('auth/dashboard');
            }
          }else{
            return Redirect::to("login")->withErrors('You need to confirm your account, please check your email');
          }
        }
        return Redirect::to("login")->with('warning','You have entered invalid username or password');
    }

    /**
     * advocate register
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function AdvocatePostRegistration(Request $request)
    {
        request()->validate([
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'phone_number' => 'required',
        'password' => 'required|min:6',
        ]);

        $user = $request->all();

        $check = $this->create($user);

        return Redirect::to("login")->with('success','We have sent you an activation link, please check your email.');
    }


    
    /**
     * view dashboard
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function get_dashboard()
    {
      if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $qualification = Qualification::where('user_id', $user_id)->first();
        $attachment = Document::where('user_id', $user_id)->first();
        $llb = LlbCollege::where('user_id', $user_id)->first();
        $lst = LstCollege::where('user_id', $user_id)->first();
        // $experience = WorkExperience::where('user_id', $user_id)->first();
        $progress = ApplicationMove::where('user_id', $user_id)->first();
        $petition_form = PetitionForm::where('user_id', $user_id)->first();

        //Count advocates

          $practising = "PRACTISING";
          $non_practising = "NON_PRACTISING";
          $suspended = "SUSPENDED";
          $retired = "RETIRED";
          $deceased = "DECEASED";
          $deferred = "DEFERRED";
          $non_profit = "NON_PROFIT";
          $struck_out = "STRUCK_OUT";
          $retired = "RETIRED";


          $practising_count = Advocate::where('status','=',$practising)->count();
          $active_practising_count = Advocate::where('status','=',$practising)->where('paid_year', '=', date('Y'))->count();
          $non_practising_count = Advocate::where('status','=',$non_practising)->count();
          $active_non_practising_count = Advocate::where('status','=',$non_practising)->where('paid_year', '=', date('Y'))->count();
          $suspended_count = Advocate::where('status','=',$suspended)->count();
          $non_profit_count = Advocate::where('status','=',$non_profit)->count();
          $retired_count = Advocate::where('status','=',$retired)->count();
          $deferred_count = Advocate::where('status','=',$deferred)->count();
          $deceased_count = Advocate::where('status','=',$deceased)->count();
          $struck_out_count = Advocate::where('status','=',$struck_out)->count();
          $retired_count = Advocate::where('status', '=', $retired)->count();

          $all_count = Advocate::all()->count();

          $practising_percent = round($practising_count/$all_count*100,2);
          $non_practising_percent = round($non_practising_count/$all_count*100,2);
          $suspended_percent = round($suspended_count/$all_count*100,2);
          $non_profit_percent = round($non_profit_count/$all_count*100,2);
          $retired_percent = round($retired_count/$all_count*100,2);
          $deferred_percent = round($deferred_count/$all_count*100,2);
          $deceased_percent = round($deceased_count/$all_count*100,2);
          $struck_out_percent = round($struck_out_count/$all_count*100,2);
          $retired_percent = round($retired_count / $all_count * 100, 2);

          $all_percent = $all_count/$all_count*100;

        //dd($progress);exit;
        return view('management.dashboard', [
          'profile' => $profile,
          'active_practising_count' => $active_practising_count,
          'active_non_practising_count' => $active_non_practising_count,
          'progress' => $progress,
          'qualification' => $qualification,
          // 'experience' => $experience,
          'llb' => $llb,
          'lst' => $lst,
          'attachment' => $attachment,
          'petition_form' => $petition_form,
          //count
          'practising_count' => $practising_count,
          'retired_count' => $retired_count,
          'non_practising_count' => $non_practising_count,
          'suspended_count' => $suspended_count,
          'non_profit_count' => $non_profit_count,
          'retired_count' => $retired_count,
          'deferred_count' => $deferred_count,
          'deceased_count' => $deceased_count,
          'struck_out_count' => $struck_out_count,
          'all_count' => $all_count,
          // percent
          'practising_percent' => $practising_percent,
          'retired_percent' => $retired_percent,
          'non_practising_percent' => $non_practising_percent,
          'suspended_percent' => $suspended_percent,
          'non_profit_percent' => $non_profit_percent,
          'retired_percent' => $retired_percent,
          'deferred_percent' => $deferred_percent,
          'deceased_percent' => $deceased_percent,
          'struck_out_percent' => $struck_out_percent,
          'all_percent' => $all_percent,
        ]);
      }
      return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * view petitioner profile
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function petitioner_profile()
    {
      if(Auth::check()){
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        // dd($profile);
        $qualification = Qualification::where('user_id', $user_id)->first();
        $attachment = Document::where('user_id', $user_id)->first();
        $llb = LlbCollege::where('user_id', $user_id)->first();
        $lst = LstCollege::where('user_id', $user_id)->first();
        $experience = WorkExperience::where('user_id', $user_id)->first();

        //check experience
                // if(WorkExperience::where('user_id', $user_id)->exists()){
                //     $experience = WorkExperience::where('user_id', $user_id)->get();
                // }else{
                //     $experience = "No data";
                // }
        $progress = ApplicationMove::where('user_id', $user_id)->first();
        $petition_form = PetitionForm::where('user_id', $user_id)->first();
        // dd($progress);
        return view('advocates.profile.petitioner', [
          'profile' => $profile,
          'progress' => $progress,
          'qualification' => $qualification,
          'experience' => $experience,
          'llb' => $llb,
          'lst' => $lst,
          'attachment' => $attachment,
          'petition_form' => $petition_form,
        ]);
      }
      return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * view advocate profile
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function advocate_profile()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();

            $cur_year = date('Y');
            $profile_id = Profile::where('user_id', $user_id)->first()->id;
            $advocate = Advocate::where('profile_id', $profile_id)->first();

            $image_url = "http://154.118.230.212/data/tams/profiles/".$profile_id;

            //dd($progress);exit;
            return view('advocates.profile.dashboard', [
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'experience' => $experience,
                'llb' => $llb,
                'lst' => $lst,
                'attachment' => $attachment,
                'petition_form' => $petition_form,
                'cur_year' => $cur_year,
                'advocate' => $advocate,
                'image_url' => $image_url,
                'profile_id' => $profile_id,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    public function create(array $data)
	{
    $petitioner = 1;
    $uuid = Str::uuid();
    $active = "false";
    $accnt_non_expired = "true";
    $accnt_non_locked = "true";
    $credential_non_expired = "true";
    $enabled = "true";
    $passwd_reset_requested = "true";
    $reset_passwd = "false";
    $role = "Advocate";
	  $user = User::create([
	    'username' => $data['username'],
        'full_name' => $data['username'],
	    'email' => $data['email'],
        'phone_number' => $data['phone_number'],
        'active' => $active,
        'uid' => $uuid,
        'account_non_expired' => $accnt_non_expired,
        'account_non_locked' => $accnt_non_locked,
        'credentials_non_expired' => $credential_non_expired,
        'enabled' => $enabled,
        'password_reset_request' => $passwd_reset_requested,
        'reset_password' => $reset_passwd,
        'petitioner' => $petitioner,
	    'password' => Hash::make($data['password'])
	  ]);

    if($user->wasRecentlyCreated){
      $user->assignRole($role);

    // Send user verification email
    $token = Str::random(64);

    $verifyUser = VerifyUser::create([
      'user_id' => $user->id,
      'token' =>  $token
    ]);
   

    \Mail::to($user->email)->send(new VerifyMail($user));
    return $user;
   


    }

	}





  

	public function logout() 
  {
        Session::flush();
        Auth::logout();
        return Redirect('login');
  }


    public function verifyUser($token)
    {
      $date = date('y-m-d h:i:s');
      $verifyUser = VerifyUser::where('token', $token)->first();
      $status = 'Sorry your email cannot be identified.';

      if(isset($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->verified) {
          $verifyUser->user->verified = 1;
          $verifyUser->user->email_verified_at = $date;
          $verifyUser->user->save();

          $status = "Your e-mail is verified. You can now login.";
        } else {
          $status = "Your account is already verified. You can now login.";
        }
      } else {
        return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
      }
      return redirect('/login')->with('success', $status);
    }

    // ****** Restricting User Access for Un-Verified Users******
    public function authenticated(Request $request, $user)
    {
      if (!$user->verified) {
        auth()->logout();
        return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
      }
      return redirect()->intended($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
      $this->guard()->logout();
      return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }





public function AdvocatePostRegister(Request $request)
    {
        $request->validate([
            'national_id' => 'required',
        ]);

        $nationalId = $request->input('national_id');

        // Make API call to check National ID existence
        $response = Http::get('https://gorest.co.in/public/v2/users', [
            'id' => $nationalId,
        ]);
        if ($response->successful() && $response->json()) {
            $user = Profile::where('id_number', $nationalId)->first();
            if ($user) {
              return back()->withErrors(['national_id' => 'National ID Already Used'])->withInput();
        } else {
              return view('auth.advocate-register', ['nationalId' => $nationalId]);
        }
        } else {
            return back()->withErrors(['national_id' => 'Invalid National ID'])->withInput();
        }
    }


public function AdvocatePostWithApiRegistration(Request $request)
{
    // Validate the National ID field
    $request->validate([
        'national_id' => 'required',
       
    ]);

    // Make a request to the external API to check the National ID
    $response = Http::get('https://example-api.com/check-national-id', [
        'national_id' => $request->national_id,
    ]);

    if ($response->successful() && $response['valid']) {
        // National ID is valid, retrieve additional data from the API response
        $nationalIdData = $response['data']; // Assuming the API response contains additional user data

        // Create the new user in the database
        $user = User::create([
            'password' => bcrypt($request->password),
            // Assign additional data from the API response
            'additional_field_1' => $nationalIdData['additional_field_1'],
            'additional_field_2' => $nationalIdData['additional_field_2'],
            // Add other associated fields as needed
        ]);
        $user = $request->all();
        $check = $this->create($user);
        // Rest of the code...

        return redirect()->route('login')->with('success', 'We have sent you an activation link, please check your email.');
    } else {
        // National ID is invalid or not found in the API response
        return back()->withErrors(['national_id' => 'Invalid National ID'])->withInput();
    }
}


public function autoLogin($token)
{
      
$petition_session_id = PetitionSession::where('active', true)->first()->id;
 $applications = Appearance::where('petition_session_id', $petition_session_id)
           ->whereDate('appear_date', '<', Carbon::today())->latest('appear_date')->value('appear_date');

if ($applications) {

    $users = User::select('users.id', 'users.full_name', 'users.email', 'users.phone_number', 'users.username', 'users.address', 'ru.role_id')
        ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
        ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
        ->groupBy('users.id', 'ru.role_id')
        ->with('roles')
        ->where('ro.id', 13)
        ->orderBy('users.id', 'DESC')
        ->get();

    foreach ($users as $user) {
        // Generate and store the login token for the user
        $loginToken = Str::random(60); // Generate a random login token
        $user->login_token = $loginToken;
        $user->save();

        // Send the email with the login link
        $loginLink = route('login.auto', ['token' => $loginToken]);
        $data = [
            'loginLink' => $loginLink,
            'user' => $user,
        ];
        Mail::to($user->email)->send(new \App\Mail\LoginLinkMail($data));
    }
}
}



public function sendEmail()
{
  $petition_session_id = PetitionSession::where('active', true)->first()->id;
  dd($petition_session_id);
    $applications = Appearance::where('petition_session_id', $petition_session_id)
        ->whereDate('appear_date', '<', Carbon::today())->latest('appear_date')->value('appear_date');
    if ($applications) {
        $users = User::select('users.id', 'users.full_name', 'users.email', 'users.phone_number', 'users.username', 'users.address', 'ru.role_id')
            ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
            ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
            ->groupBy('users.id', 'ru.role_id')
            ->with('roles')
            ->where('ro.id', 13)
            ->orderBy('users.id', 'DESC')
            ->get();

        foreach ($users as $user) {
            // Generate and store the login token for the user
            $loginToken = Str::random(60); // Generate a random login token
            $user->login_token = $loginToken;
            $user->save();

            // Send the email with the login link
            $loginLink = route('login.auto', ['token' => $loginToken]);
            $data = [
                'loginLink' => $loginLink,
                'user' => $user,
            ];

            Mail::to($user->email)->send(new \App\Mail\LoginLinkMail($data));
        }
    }
}


}