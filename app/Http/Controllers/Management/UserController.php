<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Profile;
use App\User;
use Illuminate\Support\Str;
use App\Roles;
use App\RoleUser;
use App\ActionUserTypeUser;
use App\Models\Masterdata\ActionUserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    /**
     * get a listing of users.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request) 
    {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $permissions = Permission::orderBy('name')->get();

            $users = User::orderBy('full_name')->get();
            $usertypes = ActionUserType::orderBy('name')->get();

            $roles = Role::where('name','<>','super-admin')->orderBy('name')->get();
         
             $staffs = User::select('users.id', 'users.full_name', 'users.email',
             'users.phone_number', 'users.username','users.address',
              'ru.role_id')
              ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
              ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
              ->groupBy('users.id', 'ru.role_id')
               ->with('roles')
               ->orderBy('users.id', 'DESC')
               ->paginate(100);

           
                $nonstaffs = User::select('users.id', 'users.full_name', 'users.email',
                              'users.phone_number', 'users.username','users.address',
                               'ru.role_id')
                              ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
                              ->join('action_user_type_users as ac', 'ac.user_id', '=', 'users.id')
                              ->paginate(300);

                $cle = User::select('users.id', 'users.full_name', 'users.email',
                              'users.phone_number', 'users.username','users.address',
                               'ru.role_id')
                              ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
                              ->join('action_user_type_users as ac', 'ac.user_id', '=', 'users.id')
                              ->paginate(100);


            return view('management.user_management.users.index', 
            compact('profile','permissions','roles','staffs','nonstaffs', 'usertypes'))
            ->with('i', ($request->input('page', 1) - 1 ) * 100);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }



     public function get_lp()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $usertypes = ActionUserType::orderBy('name')->get();
            $roles = Role::where('name', '<>', 'super-admin')->orderBy('name')->get();
            // $cles = User::select('users.id', 'users.full_name', 'users.email',
            //                   'users.phone_number', 'users.username', 'ac.action_user_type_id')
            //                   ->leftjoin('action_user_type_users as ac', 'ac.user_id', '=', 'users.id')
            //                   ->where('action_user_type_id', 7)
            //                   ->get();

            $cles = User::select('users.id', 'users.full_name', 'users.email',
             'users.phone_number', 'users.username','users.address',
              'ru.role_id')
              ->join('role_users as ru', 'ru.user_id', '=', 'users.id')
              ->join('roles as ro', 'ro.id', '=', 'ru.role_id')
              ->groupBy('users.id', 'ru.role_id')
               ->with('roles')
             ->where('ro.id', 13)
               ->orderBy('users.id', 'DESC')
               ->get(); 
               
            //    dd($cles);


            return view('management.user_management.users.lp-members', [
                'cles' => $cles,
                'usertypes' => $usertypes,
                'roles' => $roles
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }



    public function get_cle()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $usertypes = ActionUserType::orderBy('name')->get();
            $roles = Role::where('name', '<>', 'super-admin')->orderBy('name')->get();
            $cles = User::select('users.id', 'users.full_name', 'users.email',
                              'users.phone_number', 'users.username','cle.title', 'ac.action_user_type_id')
                              ->leftjoin('action_user_type_users as ac', 'ac.user_id', '=', 'users.id')
                              ->join('cle_members as cle', 'cle.user_id', '=', 'users.id')
                              ->where('action_user_type_id', 5)
                              ->with('actionusers')
                              ->get();

                    //    dd($cles);

            return view('management.user_management.users.cle-members', [
                'cles' => $cles,
                'usertypes' => $usertypes,
                'roles' => $roles
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_user(Request $request)
    {

        if(Auth::check()){
$uuid = Str::uuid();
$request->request->add(['password' => bcrypt($request->get('password'))]);
$request->request->add(['active' => 'true']);
$request->request->add(['enabled' => 'true']);
$request->request->add(['account_non_expired' => 'true']);
$request->request->add(['account_non_locked' => 'true']);
$request->request->add(['credentials_non_expired' => 'true']);
$request->request->add(['uid' => $uuid]);
$user = User::create($request->all());
$request->request->add(['user_id' => $user->id]);

$usertypeuser = RoleUser::create([
    "user_id" => $user->id,
    "role_id" => $request->role_id,
]);

ActionUserTypeUser::create([
    "user_id" => $user->id,
    "action_user_type_id" => $request->action_user_type_id,
]);



            return back()->with('success', 'User added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_user(Request $request, $id)
    {

        if(Auth::check()){

            try {
                $this->validate($request, [
            'full_name' => [
                'max:255',
                Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
        ]);

        $input = $request->except('password');
        if (!isset($input['active'])) {
            $input['active'] = false;
        }

        if (!empty($request['password'])) {
            $input['password'] = bcrypt($request['password']);
        }

        $lims_user_data = User::find($id);
        $lims_user_data->update($input);

                return back()->with('success', 'User  edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User permission not added');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_user(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $user = User::findOrFail($id);
                $user->delete();

                return back()->with('success', 'User  deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    public function profile()
    {
        
       if (Auth::check()) {
            $lims_user_data = User::where('id', Auth()->user()->id)->first();
            //  $staffs = User::select('users.id', 'users.full_name', 'users.email',
            //                   'users.phone_number', 'users.username',
            //                    'ru.role_id')
            //                   ->join('role_user as ru', 'ru.user_id', '=', 'users.id')
            //                   ->join('roles as ro', 'ro.role_id', '=', 'ru.id')
            //                   ->where('id', auth()->user()->id)
            //                    ->get();
            // $role = DB::table('roles')->find($staffs->role_id);
            // dd($staffs);
            return view('management.user_management.users.profile', compact('lims_user_data'));
        } else {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }

    }

    public function profileUpdate(Request $request, $id)
    {
        // if(!env('USER_VERIFIED'))
        //     return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);
                return back()->with('success', 'Profile  edited successfully');
    }

    public function changePassword(Request $request, $id)
    {
        // if(!env('USER_VERIFIED'))
        //     return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        // dd($lims_user_data);
        if ($input['new_pass'] != $input['confirm_pass']) {
            return redirect("user/" . "profile/" . $id)->with('success', "Please Confirm your new password");
        }

        if (Hash::check($input['current_pass'], $lims_user_data->password)) {
            $lims_user_data->password = bcrypt($input['new_pass']);
            $lims_user_data->save();
        } else {
            return redirect("user/" . "profile/" . $id)->with('success', "Current Password doesn't match");
        }
        auth()->logout();
        return redirect('/');
    }

}