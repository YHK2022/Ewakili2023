<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\Models\Masterdata\AdvocateCategory;

class AdvocateCategoryController extends Controller
{
    /**
     * get a listing of fees fees.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $actions = AdvocateCategory::orderBy('id')->get();
            return view('management.masterdata.advocate-category.index', [
                'profile' => $profile,
                'actions' => $actions,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new fees fee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_category(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);


            $action = new AdvocateCategory();
            $action->name = $request->input('name');
            $action->description = $request->input('description');
            $action->save();

            return back()->with('success', 'Advocate Category added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit fees fee-types
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_category(Request $request, $id)
    {

        if(Auth::check()){

            try {

                $category = AdvocateCategory::findOrFail($id);

                $this->validate($request, [
                    'name' => 'required',
                    'description' => 'required',
                ]);

                $category->name = $request->input('name');
                $category->description = $request->input('description');
                //dd($fee-types);exit;
                $category->save();

                return back()->with('success', 'Advocate Category edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Advocate Category not edited');
            }

        }
        
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_category(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $category = AdvocateCategory::findOrFail($id);
                $category->delete();

                return back()->with('success', 'Advocate Category deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Advocate Category not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}