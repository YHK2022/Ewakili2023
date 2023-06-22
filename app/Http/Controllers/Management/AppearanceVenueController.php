<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Masterdata\AppearanceVenue;

class AppearanceVenueController extends Controller
{
    /**
     * get a listing of appearance.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request)
    {
        if ($request->input('all')) {
            $appearances = AppearanceVenue::orderBy('id', 'asc')->get();
        } else {
            $appearances = AppearanceVenue::get();
        }
        return view('management.masterdata.appearance.index', compact('appearances'));

    }

    /**
     * add a new attachment
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_appearance(Request $request)
    {
        if (Auth::check()) {

    $this->validate($request, [
        'name' => 'required',
        'description' => 'required'
    ]);

    $uuid = Str::uuid();

    $appearance = new AppearanceVenue();
    $appearance->name = $request->input('name');
    $appearance->description = $request->input('description');
    $appearance->created_by = Auth()->user()->id;
    $appearance->active = 'true';

    $appearance->uid = $uuid;

    //dd($fee-types);exit;
    $appearance->save();

    return back()->with('success', 'Appearance Venue added successfully');

}
return Redirect::to("auth/login")->withErrors('You do not have access!');


    }

    /**
     * show the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_appearance($id)
    {
        try {
            $district = AppearanceVenue::with('courts')->findOrFail($id);

            return response()->json([
                'code' => Response::HTTP_OK,
                'district' => $district
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }

    /**
     * edit the specified district.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_appearance(Request $request, $id)
    {
        if (Auth::check()) {

    try {

        $appearance = AppearanceVenue::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',

        ]);

        $appearance->name = $request->input('name');
        $appearance->description = $request->input('description');

        $appearance->save();

        return back()->with('success', 'Appearance Venue edited successfully');

    } catch (\Throwable $th) {

        return back()->with('warning', 'Appearance Venue not edited');
    }

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    /**
     * delete the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_appearance($id)
    {
        if (Auth::check()) {

    try {
        $permission = AppearanceVenue::findOrFail($id);
        $permission->delete();

        return back()->with('success', 'Appearance Venue deleted successfully');

    } catch (\Throwable $th) {

        return back()->with('warning', 'Appearance Venue not deleted');
    }

   }
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
}