<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Roles;

use App\Profile;

class RoleController extends Controller
{
    /**
     * get a listing of roles.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $roles = Role::orderBy('name')->get();
            //dd($profile);exit;
            return view('management.user_management.roles.index', [
                'profile' => $profile,
                'roles' => $roles,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     /**
     * add a new role
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_role(Request $request)
    {
        if(Auth::check()){

        if($request->isMethod("get")){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            return view('management.user_management.roles.add', [
                'profile' => $profile,
            ]);
        }

        $this->validate($request, [
            'name' => 'required',
        ]);

           $uuid = Str::uuid();
           $role = new Role();
            $role->name = $request->input('name');
            $role->created_by = Auth()->user()->id;
            $role->description = $request->input('description');

            $role->uid = $uuid;
            $role->active = "true";
            $role->fixed = "false";
            //dd($role);exit;
            $role->save();

      

        return back()->with('success', 'Role added successfully');


        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * show the specified role.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_role($id)
    {
        if(Auth::check()){

        try {
            $role = Role::with('permissions')->findOrFail($id);

            return response()->json([
                'code' => Response::HTTP_OK,
                'role' => $role
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * edit the specified role.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_role(Request $request, $id)
    {
        if (Auth::check()) {

    try {

        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->updated_by = Auth()->user()->id;

        //dd($role);exit;
        $role->save();

        return back()->with('success', ' stage edited successfully');

    } catch (\Throwable $th) {

        return back()->with('warning', 'Role not edited');
    }

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    /**
     * delete the specified role.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_role($id)
    {
        if(Auth::check()){

        try {
            $role = Role::with('permissions')->findOrFail($id);
            $role->delete();

            return back()->with('success', 'Role deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('warning', 'Role not deleted');

        }

    }
    return Redirect::to("auth/login")->withErrors('You do not have access!');
    }



        public function permission($id)
    {
        if (Auth::check()) {
            $lims_role_data = Roles::find($id);
            $permissions = Role::findByName($lims_role_data->name)->permissions;
            foreach ($permissions as $permission) {
                $all_permission[] = $permission->name;
            }

            if (empty($all_permission)) {
                $all_permission[] = 'dummy text';
            }
            return view('management.user_management.roles.permission', compact('lims_role_data', 'all_permission'));
        } else {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }

     


    }
      

      public function setPermission(Request $request)
    {
        $role = Role::firstOrCreate(['id' => $request['role_id']]);
    
        if ($request->has('ROLE_USER_VIEW')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_USER_VIEW']);
            if (!$role->hasPermissionTo('ROLE_USER_VIEW')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_USER_VIEW');
        }
     if ($request->has('ROLE_USER_STAFF_EDIT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_USER_STAFF_EDIT']);
            if (!$role->hasPermissionTo('ROLE_USER_STAFF_EDIT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_USER_STAFF_EDIT');
        }
         if ($request->has('ROLE_USER_STAFF_DELETE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_USER_STAFF_DELETE']);
            if (!$role->hasPermissionTo('ROLE_USER_STAFF_DELETE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_USER_STAFF_DELETE');
        }
         if ($request->has('ROLE_ACTION_USER_TYPES_VIEW')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_ACTION_USER_TYPES_VIEW']);
            if (!$role->hasPermissionTo('ROLE_ACTION_USER_TYPES_VIEW')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_ACTION_USER_TYPES_VIEW');
        }
         if ($request->has('ROLE_ROLE_ADD')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_ROLE_ADD']);
            if (!$role->hasPermissionTo('ROLE_ROLE_ADD')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_ROLE_ADD');
        }
        if ($request->has('ROLE_ROLE_VIEW')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_ROLE_VIEW']);
    if (!$role->hasPermissionTo('ROLE_ROLE_VIEW')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_ROLE_VIEW');
}
if ($request->has('ROLE_ROLE_EDIT')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_ROLE_EDIT']);
    if (!$role->hasPermissionTo('ROLE_ROLE_EDIT')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_ROLE_EDIT');
}
if ($request->has('ROLE_ROLE_DELETE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_ROLE_DELETE']);
    if (!$role->hasPermissionTo('ROLE_ROLE_DELETE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_ROLE_DELETE');
}
if ($request->has('ROLE_ROLE_ASSIGN_PERMISSIONS')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_ROLE_ASSIGN_PERMISSIONS']);
    if (!$role->hasPermissionTo('ROLE_ROLE_ASSIGN_PERMISSIONS')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_ROLE_ASSIGN_PERMISSIONS');
}
if ($request->has('ROLE_MANAGE_PROFILE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_PROFILE']);
    if (!$role->hasPermissionTo('ROLE_MANAGE_PROFILE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_MANAGE_PROFILE');
}
if ($request->has('ROLE_CREATE_PROFILE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_PROFILE']);
    if (!$role->hasPermissionTo('ROLE_CREATE_PROFILE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_CREATE_PROFILE');
}
if ($request->has('ROLE_UPDATE_PROFILE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_PROFILE']);
    if (!$role->hasPermissionTo('ROLE_UPDATE_PROFILE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_UPDATE_PROFILE');
}
if ($request->has('ROLE_DELETE_PROFILE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_PROFILE']);
    if (!$role->hasPermissionTo('ROLE_DELETE_PROFILE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_DELETE_PROFILE');
}
if ($request->has('ROLE_VIEW_PROFILE_DETAILS')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_PROFILE_DETAILS']);
    if (!$role->hasPermissionTo('ROLE_VIEW_PROFILE_DETAILS')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_VIEW_PROFILE_DETAILS');
}
if ($request->has('ROLE_MANAGE_QUALIFICATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_QUALIFICATION']);
    if (!$role->hasPermissionTo('ROLE_MANAGE_QUALIFICATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_MANAGE_QUALIFICATION');
}
if ($request->has('ROLE_CREATE_QUALIFICATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_QUALIFICATION']);
    if (!$role->hasPermissionTo('ROLE_CREATE_QUALIFICATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_CREATE_QUALIFICATION');
}
if ($request->has('ROLE_UPDATE_QUALIFICATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_QUALIFICATION']);
    if (!$role->hasPermissionTo('ROLE_UPDATE_QUALIFICATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_UPDATE_QUALIFICATION');
}
if ($request->has('ROLE_DELETE_QUALIFICATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_QUALIFICATION']);
    if (!$role->hasPermissionTo('ROLE_DELETE_QUALIFICATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_DELETE_QUALIFICATION');
}
if ($request->has('ROLE_ASSIGN_QUALIFICATION_ATTACHMENT')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_ASSIGN_QUALIFICATION_ATTACHMENT']);
    if (!$role->hasPermissionTo('ROLE_ASSIGN_QUALIFICATION_ATTACHMENT')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_ASSIGN_QUALIFICATION_ATTACHMENT');
}
if ($request->has('ROLE_CREATE_USER_QUALIFICATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_USER_QUALIFICATION']);
    if (!$role->hasPermissionTo('ROLE_CREATE_USER_QUALIFICATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_CREATE_USER_QUALIFICATION');
}
if ($request->has('ROLE_VIEW_USER_QUALIFICATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_USER_QUALIFICATION']);
    if (!$role->hasPermissionTo('ROLE_VIEW_USER_QUALIFICATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_VIEW_USER_QUALIFICATION');
}
 if ($request->has('ROLE_MANAGE_ATTACHMENT_TYPE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_ATTACHMENT_TYPE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_ATTACHMENT_TYPE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_ATTACHMENT_TYPE');
        }
        if ($request->has('ROLE_CREATE_ATTACHMENT_TYPE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_ATTACHMENT_TYPE']);
    if (!$role->hasPermissionTo('ROLE_CREATE_ATTACHMENT_TYPE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_CREATE_ATTACHMENT_TYPE');
}
if ($request->has('ROLE_UPDATE_ATTACHMENT_TYPE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_ATTACHMENT_TYPE']);
    if (!$role->hasPermissionTo('ROLE_UPDATE_ATTACHMENT_TYPE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_UPDATE_ATTACHMENT_TYPE');
}
if ($request->has('ROLE_DELETE_ATTACHMENT_TYPE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_ATTACHMENT_TYPE']);
    if (!$role->hasPermissionTo('ROLE_DELETE_ATTACHMENT_TYPE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_DELETE_ATTACHMENT_TYPE');
}
if ($request->has('ROLE_MANAGE_PETITION_EDUCATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_PETITION_EDUCATION']);
    if (!$role->hasPermissionTo('ROLE_MANAGE_PETITION_EDUCATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_MANAGE_PETITION_EDUCATION');
}
if ($request->has('ROLE_CREATE_PETITION_EDUCATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_PETITION_EDUCATION']);
    if (!$role->hasPermissionTo('ROLE_CREATE_PETITION_EDUCATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_CREATE_PETITION_EDUCATION');
}
if ($request->has('ROLE_UPDATE_PETITION_EDUCATION')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_PETITION_EDUCATION']);
    if (!$role->hasPermissionTo('ROLE_UPDATE_PETITION_EDUCATION')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_UPDATE_PETITION_EDUCATION');
}
if ($request->has('ROLE_MANAGE_WORK_EXPERIENCE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_WORK_EXPERIENCE']);
    if (!$role->hasPermissionTo('ROLE_MANAGE_WORK_EXPERIENCE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_MANAGE_WORK_EXPERIENCE');
}
if ($request->has('ROLE_CREATE_WORK_EXPERIENCE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_WORK_EXPERIENCE']);
    if (!$role->hasPermissionTo('ROLE_CREATE_WORK_EXPERIENCE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_CREATE_WORK_EXPERIENCE');
}
if ($request->has('ROLE_UPDATE_WORK_EXPERIENCE')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_WORK_EXPERIENCE']);
    if (!$role->hasPermissionTo('ROLE_UPDATE_WORK_EXPERIENCE')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_UPDATE_WORK_EXPERIENCE');
}
if ($request->has('ROLE_MANAGE_COUNTRY')) {
    $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_COUNTRY']);
    if (!$role->hasPermissionTo('ROLE_MANAGE_COUNTRY')) {
        $role->givePermissionTo($permission);
    }
} else {
    $role->revokePermissionTo('ROLE_MANAGE_COUNTRY');
}
 if ($request->has('ROLE_MANAGE_PROFILE_ADDRESS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_PROFILE_ADDRESS']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_PROFILE_ADDRESS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_PROFILE_ADDRESS');
        } 
        if ($request->has('ROLE_CREATE_PROFILE_ADDRESS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_PROFILE_ADDRESS']);
            if (!$role->hasPermissionTo('ROLE_CREATE_PROFILE_ADDRESS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_PROFILE_ADDRESS');
        } 
        if ($request->has('ROLE_UPDATE_PROFILE_ADDRESS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_PROFILE_ADDRESS']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_PROFILE_ADDRESS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_PROFILE_ADDRESS');
        }
         if ($request->has('ROLE_DELETE_PROFILE_ADDRESS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_PROFILE_ADDRESS']);
            if (!$role->hasPermissionTo('ROLE_DELETE_PROFILE_ADDRESS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_PROFILE_ADDRESS');
        } 
        if ($request->has('ROLE_MANAGE_PROFILE_CONTACT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_PROFILE_CONTACT']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_PROFILE_CONTACT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_PROFILE_CONTACT');
        } 
        if ($request->has('ROLE_CREATE_PROFILE_CONTACT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_PROFILE_CONTACT']);
            if (!$role->hasPermissionTo('ROLE_CREATE_PROFILE_CONTACT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_PROFILE_CONTACT');
        } 
        if ($request->has('ROLE_UPDATE_PROFILE_CONTACT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_PROFILE_CONTACT']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_PROFILE_CONTACT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_PROFILE_CONTACT');
        } 
        if ($request->has('ROLE_DELETE_PROFILE_CONTACT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_PROFILE_CONTACT']);
            if (!$role->hasPermissionTo('ROLE_DELETE_PROFILE_CONTACT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_PROFILE_CONTACT');
        }
         if ($request->has('ROLE_MANAGE_REGION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_REGION']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_REGION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_REGION');
        } 
        if ($request->has('ROLE_CREATE_REGION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_REGION']);
            if (!$role->hasPermissionTo('ROLE_CREATE_REGION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_REGION');
        } 
        if ($request->has('ROLE_UPDATE_REGION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_REGION']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_REGION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_REGION');
        }
         if ($request->has('ROLE_DELETE_REGION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_REGION']);
            if (!$role->hasPermissionTo('ROLE_DELETE_REGION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_REGION');
        } 
        if ($request->has('ROLE_MANAGE_DISTRICT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_DISTRICT']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_DISTRICT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_DISTRICT');
        } 
        if ($request->has('ROLE_CREATE_DISTRICT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_DISTRICT']);
            if (!$role->hasPermissionTo('ROLE_CREATE_DISTRICT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_DISTRICT');
        } 
        if ($request->has('ROLE_UPDATE_DISTRICT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_DISTRICT']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_DISTRICT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_DISTRICT');
        } 
        if ($request->has('ROLE_DELETE_DISTRICT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_DISTRICT']);
            if (!$role->hasPermissionTo('ROLE_DELETE_DISTRICT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_DISTRICT');
        } 
        if ($request->has('ROLE_MANAGE_FIRM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_FIRM']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_FIRM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_FIRM');
        } 
        if ($request->has('ROLE_CREATE_FIRM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_FIRM']);
            if (!$role->hasPermissionTo('ROLE_CREATE_FIRM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_FIRM');
        } 
        if ($request->has('ROLE_APPROVE_FIRM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_APPROVE_FIRM']);
            if (!$role->hasPermissionTo('ROLE_APPROVE_FIRM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_APPROVE_FIRM');
        } 
        if ($request->has('ROLE_APPLY_FIRM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_APPLY_FIRM']);
            if (!$role->hasPermissionTo('ROLE_APPLY_FIRM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_APPLY_FIRM');
        } 
        if ($request->has('ROLE_CONFIRM_FIRM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CONFIRM_FIRM']);
            if (!$role->hasPermissionTo('ROLE_CONFIRM_FIRM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CONFIRM_FIRM');
        } 
        if ($request->has('ROLE_CREATE_PETITION_APPLICATION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_PETITION_APPLICATION']);
            if (!$role->hasPermissionTo('ROLE_CREATE_PETITION_APPLICATION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_PETITION_APPLICATION');
        } 
        if ($request->has('ROLE_APPROVE_APPLICATION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_APPROVE_APPLICATION']);
            if (!$role->hasPermissionTo('ROLE_APPROVE_APPLICATION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_APPROVE_APPLICATION');
        } 
        if ($request->has('ROLE_VIEW_APPLICATION_BY_ACTION_USER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_APPLICATION_BY_ACTION_USER']);
            if (!$role->hasPermissionTo('ROLE_VIEW_APPLICATION_BY_ACTION_USER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_APPLICATION_BY_ACTION_USER');
        } 
        if ($request->has('ROLE_VIEW_USER_APPLICATION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_USER_APPLICATION']);
            if (!$role->hasPermissionTo('ROLE_VIEW_USER_APPLICATION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_USER_APPLICATION');
        } 
        if ($request->has('ROLE_VIEW_APPROVAL_DECION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_APPROVAL_DECION']);
            if (!$role->hasPermissionTo('ROLE_VIEW_APPROVAL_DECION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_APPROVAL_DECION');
        } 
        if ($request->has('ROLE_CREATE_PERMIT_APPLICATION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_PERMIT_APPLICATION']);
            if (!$role->hasPermissionTo('ROLE_CREATE_PERMIT_APPLICATION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_PERMIT_APPLICATION');
        } 
        if ($request->has('ROLE_VIEW_USER_APPLICATION_DOCUMENT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_USER_APPLICATION_DOCUMENT']);
            if (!$role->hasPermissionTo('ROLE_VIEW_USER_APPLICATION_DOCUMENT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_USER_APPLICATION_DOCUMENT');
        } 
        if ($request->has('ROLE_CREATE_RENEWAL_APPLICATION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_RENEWAL_APPLICATION']);
            if (!$role->hasPermissionTo('ROLE_CREATE_RENEWAL_APPLICATION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_RENEWAL_APPLICATION');
        }
         if ($request->has('ROLE_ENROLL_PETITIONERS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_ENROLL_PETITIONERS']);
            if (!$role->hasPermissionTo('ROLE_ENROLL_PETITIONERS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_ENROLL_PETITIONERS');
        }
         if ($request->has('ROLE_CHANGE_PETITION_ADMIT_AS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CHANGE_PETITION_ADMIT_AS']);
            if (!$role->hasPermissionTo('ROLE_CHANGE_PETITION_ADMIT_AS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CHANGE_PETITION_ADMIT_AS');
        } 
        if ($request->has('ROLE_VIEW_ADVOCATE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_ADVOCATE']);
            if (!$role->hasPermissionTo('ROLE_VIEW_ADVOCATE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_ADVOCATE');
        } 
        if ($request->has('ROLE_CHOOSE_VENUE_APPEARANCE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CHOOSE_VENUE_APPEARANCE']);
            if (!$role->hasPermissionTo('ROLE_CHOOSE_VENUE_APPEARANCE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CHOOSE_VENUE_APPEARANCE');
        }
         if ($request->has('ROLE_CREATE_BAR_EXAM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_BAR_EXAM']);
            if (!$role->hasPermissionTo('ROLE_CREATE_BAR_EXAM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_BAR_EXAM');
        } 
        if ($request->has('ROLE_UPDATE_BAR_EXAM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_BAR_EXAM']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_BAR_EXAM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_BAR_EXAM');
        } 
        if ($request->has('ROLE_VIEW_CJ_INTERVIEW_PETITIONER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_CJ_INTERVIEW_PETITIONER']);
            if (!$role->hasPermissionTo('ROLE_VIEW_CJ_INTERVIEW_PETITIONER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_CJ_INTERVIEW_PETITIONER');
        } 
        
        if ($request->has('ROLE_VIEW_PENDING_ADMISSION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_PENDING_ADMISSION']);
            if (!$role->hasPermissionTo('ROLE_VIEW_PENDING_ADMISSION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_PENDING_ADMISSION');
        } 
        if ($request->has('ROLE_RESUBMIT_APPLICATION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_RESUBMIT_APPLICATION']);
            if (!$role->hasPermissionTo('ROLE_RESUBMIT_APPLICATION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_RESUBMIT_APPLICATION');
        } 
        if ($request->has('ROLE_MANAGE_WORKFLOW_PROCESS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_WORKFLOW_PROCESS']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_WORKFLOW_PROCESS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_WORKFLOW_PROCESS');
        } 
        if ($request->has('ROLE_MANAGE_WORKFLOW_STAGE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_WORKFLOW_STAGE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_WORKFLOW_STAGE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_WORKFLOW_STAGE');
        } 
        if ($request->has('ROLE_CREATE_WORKFLOW_STAGE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_WORKFLOW_STAGE']);
            if (!$role->hasPermissionTo('ROLE_CREATE_WORKFLOW_STAGE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_WORKFLOW_STAGE');
        } 
        if ($request->has('ROLE_ASSIGN_WORKFLOW_ATTACHMENT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_ASSIGN_WORKFLOW_ATTACHMENT']);
            if (!$role->hasPermissionTo('ROLE_ASSIGN_WORKFLOW_ATTACHMENT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_ASSIGN_WORKFLOW_ATTACHMENT');
        } 
        if ($request->has('ROLE_VIEW_WORKFLOW_ATTACHMENT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_WORKFLOW_ATTACHMENT']);
            if (!$role->hasPermissionTo('ROLE_VIEW_WORKFLOW_ATTACHMENT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_WORKFLOW_ATTACHMENT');
        } 
        if ($request->has('ROLE_MANAGE_VENUE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_VENUE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_VENUE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_VENUE');
        }
        if ($request->has('ROLE_CREATE_VENUE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_VENUE']);
            if (!$role->hasPermissionTo('ROLE_CREATE_VENUE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_VENUE');
        }
        if ($request->has('ROLE_UPDATE_VENUE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_VENUE']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_VENUE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_VENUE');
        }
        if ($request->has('ROLE_DELETE_VENUE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_VENUE']);
            if (!$role->hasPermissionTo('ROLE_DELETE_VENUE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_VENUE');
        }
        if ($request->has('ROLE_CREATE_APPEARANCE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_APPEARANCE']);
            if (!$role->hasPermissionTo('ROLE_CREATE_APPEARANCE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_APPEARANCE');
        }
        if ($request->has('ROLE_MANAGE_APPEARANCE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_APPEARANCE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_APPEARANCE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_APPEARANCE');
        }
        if ($request->has('ROLE_CAN_APPLY_FOR_VENUE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CAN_APPLY_FOR_VENUE']);
            if (!$role->hasPermissionTo('ROLE_CAN_APPLY_FOR_VENUE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CAN_APPLY_FOR_VENUE');
        }
        if ($request->has('ROLE_MANAGE_SESSION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_SESSION']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_SESSION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_SESSION');
        }
        if ($request->has('ROLE_CREATE_SESSION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_SESSION']);
            if (!$role->hasPermissionTo('ROLE_CREATE_SESSION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_SESSION');
        }
        if ($request->has('ROLE_UPDATE_SESSION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_SESSION']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_SESSION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_SESSION');
        }
        if ($request->has('ROLE_DELETE_SESSION')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_SESSION']);
            if (!$role->hasPermissionTo('ROLE_DELETE_SESSION')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_SESSION');
        }
        if ($request->has('ROLE_VIEW_CLE_MEMBER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_CLE_MEMBER']);
            if (!$role->hasPermissionTo('ROLE_VIEW_CLE_MEMBER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_CLE_MEMBER');
        }
        if ($request->has('ROLE_UPDATE_CLE_MEMBER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_CLE_MEMBER']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_CLE_MEMBER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_CLE_MEMBER');
        }
        if ($request->has('ROLE_VIEW_CLE_CORAM')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_CLE_CORAM']);
            if (!$role->hasPermissionTo('ROLE_VIEW_CLE_CORAM')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_CLE_CORAM');
        }
        if ($request->has('ROLE_VIEW_RENEWAL_BATCH')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_RENEWAL_BATCH']);
            if (!$role->hasPermissionTo('ROLE_VIEW_RENEWAL_BATCH')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_RENEWAL_BATCH');
        }
        if ($request->has('ROLE_CREATE_RENEWAL_BATCH')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_RENEWAL_BATCH']);
            if (!$role->hasPermissionTo('ROLE_CREATE_RENEWAL_BATCH')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_RENEWAL_BATCH');
        }
        if ($request->has('ROLE_UPDATE_RENEWAL_BATCH')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_RENEWAL_BATCH']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_RENEWAL_BATCH')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_RENEWAL_BATCH');
        }
        if ($request->has('ROLE_PRE_ASSIGN_ROLL_NUMBER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_PRE_ASSIGN_ROLL_NUMBER']);
            if (!$role->hasPermissionTo('ROLE_PRE_ASSIGN_ROLL_NUMBER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_PRE_ASSIGN_ROLL_NUMBER');
        }
        if ($request->has('ROLE_REARRANGE_ROLL_NUMBER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_REARRANGE_ROLL_NUMBER']);
            if (!$role->hasPermissionTo('ROLE_REARRANGE_ROLL_NUMBER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_REARRANGE_ROLL_NUMBER');
        }
        if ($request->has('ROLE_MANAGE_EXCHANGE_RATE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_EXCHANGE_RATE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_EXCHANGE_RATE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_EXCHANGE_RATE');
        }
        if ($request->has('ROLE_CREATE_EXCHANGE_RATE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_EXCHANGE_RATE']);
            if (!$role->hasPermissionTo('ROLE_CREATE_EXCHANGE_RATE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_EXCHANGE_RATE');
        }
        if ($request->has('ROLE_UPDATE_EXCHANGE_RATE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_EXCHANGE_RATE']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_EXCHANGE_RATE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_EXCHANGE_RATE');
        }
        if ($request->has('ROLE_DELETE_EXCHANGE_RATE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_EXCHANGE_RATE']);
            if (!$role->hasPermissionTo('ROLE_DELETE_EXCHANGE_RATE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_EXCHANGE_RATE');
        }
        if ($request->has('ROLE_SEND_RECONCILIATION_REQUEST')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_SEND_RECONCILIATION_REQUEST']);
            if (!$role->hasPermissionTo('ROLE_SEND_RECONCILIATION_REQUEST')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_SEND_RECONCILIATION_REQUEST');
        }
        if ($request->has('ROLE_MANAGE_VENUE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_VENUE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_VENUE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_VENUE');
        }
        if ($request->has('ROLE_CANCEL_BILL')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CANCEL_BILL']);
            if (!$role->hasPermissionTo('ROLE_CANCEL_BILL')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CANCEL_BILL');
        }
        if ($request->has('ROLE_REUSE_CONTROL_NUMBER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_REUSE_CONTROL_NUMBER']);
            if (!$role->hasPermissionTo('ROLE_REUSE_CONTROL_NUMBER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_REUSE_CONTROL_NUMBER');
        }
        if ($request->has('ROLE_MANAGE_BILL')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_BILL']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_BILL')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_BILL');
        }
        if ($request->has('ROLE_DELETE_RECONCILIATION_BATCH')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_RECONCILIATION_BATCH']);
            if (!$role->hasPermissionTo('ROLE_DELETE_RECONCILIATION_BATCH')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_RECONCILIATION_BATCH');
        }
        if ($request->has('ROLE_REQUEST_CONTROL_NUMBER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_REQUEST_CONTROL_NUMBER']);
            if (!$role->hasPermissionTo('ROLE_REQUEST_CONTROL_NUMBER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_REQUEST_CONTROL_NUMBER');
        }
        if ($request->has('ROLE_RE_REQUEST_CONTROL_NUMBER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_RE_REQUEST_CONTROL_NUMBER']);
            if (!$role->hasPermissionTo('ROLE_RE_REQUEST_CONTROL_NUMBER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_RE_REQUEST_CONTROL_NUMBER');
        }
        if ($request->has('ROLE_VIEW_ALL_BILL')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_ALL_BILL']);
            if (!$role->hasPermissionTo('ROLE_VIEW_ALL_BILL')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_ALL_BILL');
        }
        if ($request->has('ROLE_VIEW_APPLICANT_BILL')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_APPLICANT_BILL']);
            if (!$role->hasPermissionTo('ROLE_VIEW_APPLICANT_BILL')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_APPLICANT_BILL');
        }
        if ($request->has('ROLE_VIEW_ALL_PAYMENT')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_ALL_PAYMENT']);
            if (!$role->hasPermissionTo('ROLE_VIEW_ALL_PAYMENT')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_ALL_PAYMENT');
        }
        if ($request->has('ROLE_CHANGE_BILL')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CHANGE_BILL']);
            if (!$role->hasPermissionTo('ROLE_CHANGE_BILL')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CHANGE_BILL');
        }
        if ($request->has('ROLE_VIEW_RECONCILIATION_BATCH')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_RECONCILIATION_BATCH']);
            if (!$role->hasPermissionTo('ROLE_VIEW_RECONCILIATION_BATCH')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_RECONCILIATION_BATCH');
        }
        if ($request->has('ROLE_MANAGE_FEE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_FEE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_FEE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_FEE');
        }
        if ($request->has('ROLE_CREATE_FEE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_FEE']);
            if (!$role->hasPermissionTo('ROLE_CREATE_FEE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_FEE');
        }
        if ($request->has('ROLE_UPDATE_FEE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_FEE']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_FEE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_FEE');
        }
        if ($request->has('ROLE_DELETE_FEE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_FEE']);
            if (!$role->hasPermissionTo('ROLE_DELETE_FEE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_FEE');
        }
        if ($request->has('ROLE_MANAGE_FEETYPE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_MANAGE_FEETYPE']);
            if (!$role->hasPermissionTo('ROLE_MANAGE_FEETYPE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_MANAGE_FEETYPE');
        }
        if ($request->has('ROLE_CREATE_FEETYPE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_FEETYPE']);
            if (!$role->hasPermissionTo('ROLE_CREATE_FEETYPE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_FEETYPE');
        }
        if ($request->has('ROLE_UPDATE_FEETYPE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_FEETYPE']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_FEETYPE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_FEETYPE');
        }
        if ($request->has('ROLE_DELETE_FEETYPE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_DELETE_FEETYPE']);
            if (!$role->hasPermissionTo('ROLE_DELETE_FEETYPE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_DELETE_FEETYPE');
        }
        if ($request->has('ROLE_CREATE_LEGAL_VIEW')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_CREATE_LEGAL_VIEW']);
            if (!$role->hasPermissionTo('ROLE_CREATE_LEGAL_VIEW')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_CREATE_LEGAL_VIEW');
        }
        if ($request->has('ROLE_VIEW_LEGAL_VIEW')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_LEGAL_VIEW']);
            if (!$role->hasPermissionTo('ROLE_VIEW_LEGAL_VIEW')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_LEGAL_VIEW');
        }
        if ($request->has('ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER']);
            if (!$role->hasPermissionTo('ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_LEGAL_VIEW_BY_ACTION_USER');
        }
        if ($request->has('ROLE_LEGAL_VIEW_PETITIONER')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_LEGAL_VIEW_PETITIONER']);
            if (!$role->hasPermissionTo('ROLE_LEGAL_VIEW_PETITIONER')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_LEGAL_VIEW_PETITIONER');
        }
        if ($request->has('ROLE_APPROVE_LEGAL_VIEW')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_APPROVE_LEGAL_VIEW']);
            if (!$role->hasPermissionTo('ROLE_APPROVE_LEGAL_VIEW')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_APPROVE_LEGAL_VIEW');
        }if ($request->has('ROLE_UPDATE_ADVOCATE_STATUS')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_UPDATE_ADVOCATE_STATUS']);
            if (!$role->hasPermissionTo('ROLE_UPDATE_ADVOCATE_STATUS')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_UPDATE_ADVOCATE_STATUS');
        }
        if ($request->has('ROLE_VIEW_ADVOCATE_STATUS_CHANGE')) {
            $permission = Permission::firstOrCreate(['name' => 'ROLE_VIEW_ADVOCATE_STATUS_CHANGE']);
            if (!$role->hasPermissionTo('ROLE_VIEW_ADVOCATE_STATUS_CHANGE')) {
                $role->givePermissionTo($permission);
            }
        } else {
            $role->revokePermissionTo('ROLE_VIEW_ADVOCATE_STATUS_CHANGE');
        }
      
        return redirect('user-management/role')->with('message', 'Permission updated successfully');

    }
}