<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Masterdata\District;
use App\Models\Masterdata\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class DistrictController extends Controller
{
    /**
     * get a listing of districts.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request)
    {
        if ($request->input('all')) {
            $districts = District::orderBy('id', 'asc')->get();
        } else {
            $districts = District::get();
            $regions = Region::get();


        }
        return view('management.masterdata.district.index', compact('districts','regions'));

    }

    /**
     * add a new district
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_district(Request $request)
    {
        if (Auth::check()) {

    $this->validate($request, [
        'name' => 'required',
        'region_id' => 'required',
    ]);

    $uuid = Str::uuid();

    $district = new District();
    $district->name = $request->input('name');
    $district->region_id = $request->input('region_id');
    $district->created_by = Auth()->user()->id;
    $district->active = 'true';
    $district->deleted = 'false';
    $district->uid = $uuid;
    $district->save();

    return back()->with('success', 'District added successfully');

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    /**
     * show the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_district($id)
    {
        try {
            $district = District::with('courts')->findOrFail($id);

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
    public function edit_district(Request $request, $id)
    {
        try {
            $district = District::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'code' => 'required',
                'region_id' => 'required'
            ]);

            $district->name = $request->input('name');
            $district->code = $request->input('code');
            $district->region_id = $request->input('region_id');
            $district->save();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'District updated successfully.',
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
     * delete the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_district($id)
    {
        if (Auth::check()) {

    try {
        $district = District::findOrFail($id);
        $district->delete();

        return back()->with('success', 'District deleted successfully');

    } catch (\Throwable $th) {

        return back()->with('warning', 'District not deleted');
    }

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
}