<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Profile;

class PermissionController extends Controller
{
    /**
     * get a listing of permissions.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $permissions = Permission::orderBy('name')->get();
            $roles = Role::where('name','<>','super-admin')->orderBy('name')->get();
            // dd($permissions);
            //dd($profile);exit;
            return view('management.user_management.permission.index', [
                'profile' => $profile,
                'permissions' => $permissions,
                'roles' => $roles,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_permission(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'name' => 'required',
                'display_name' => 'required',
                'group_name' => 'required',
                'guard_name' => 'required',
            ]);

            $permission = new Permission();
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->group_name = $request->input('group_name');
            $permission->guard_name = $request->input('guard_name');
            //dd($permission);exit;
            $permission->save();

            return back()->with('success', 'User permission added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_permission(Request $request, $id)
    {

        if(Auth::check()){

            try {
                $permission = Permission::findOrFail($id);

                $this->validate($request, [
                    'name' => 'required',
                    'display_name' => 'required',
                    'group_name' => 'required',
                    'guard_name' => 'required',
                ]);

                $permission->name = $request->input('name');
                $permission->display_name = $request->input('display_name');
                $permission->group_name = $request->input('group_name');
                $permission->guard_name = $request->input('guard_name');
                //dd($permission);exit;
                $permission->save();

                return back()->with('success', 'User permission edited successfully');

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
    public function delete_permission(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $permission = Permission::findOrFail($id);
                $permission->delete();

                return back()->with('success', 'User permission deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User permission not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}