<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Masterdata\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Profile;
use Symfony\Component\HttpFoundation\Response;

class RegionController extends Controller
{
    /**
     * get a listing of regions.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request)
    {
        if ($request->input('all')) {
            $regions = Region::orderBy('id', 'asc')->get();
        } else {
            $regions = Region::with('districts')->get();
        }
           return view('management.masterdata.region.index', compact('regions'));
}



    /**
     * add a new region
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_region(Request $request)
    {
       if (Auth::check()) {

    $this->validate($request, [
        'name' => 'required',
    ]);

    $uuid = Str::uuid();

    $attachment = new Region();
    $attachment->name = $request->input('name');
    $attachment->created_by = Auth()->user()->id;
    $attachment->active = 'true';
    $attachment->uid = $uuid;

    //dd($fee-types);exit;
    $attachment->save();

    return back()->with('success', 'Region added successfully');

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    /**
     * show the specified region.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_region($id)
    {
        try {
            $region = Region::with('districts')->findOrFail($id);

            return response()->json([
                'code' => Response::HTTP_OK,
                'region' => $region
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }

    /**
     * edit the specified region.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit_region(Request $request, $id)
    {
        if (Auth::check()) {

    try {

        $region = Region::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',

        ]);

        $region->name = $request->input('name');
        $region->save();

        return back()->with('success', 'Region edited successfully');

    } catch (\Throwable $th) {

        return back()->with('warning', 'Region not edited');
    }

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

            
    }

    /**
     * delete the specified region.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_region($id)
    {
       if (Auth::check()) {

    try {
        $region = Region::findOrFail($id);
        $region->delete();

        return back()->with('success', 'Region deleted successfully');

    } catch (\Throwable $th) {

        return back()->with('warning', 'Region not deleted');
    }

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
}