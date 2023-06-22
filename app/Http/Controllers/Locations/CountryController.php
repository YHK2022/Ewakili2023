<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masterdata\Country;

class CountryController extends Controller
{
    /**
     * get a listing of districts.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request)
    {
        if ($request->input('all')) {
            $countries = Country::orderBy('id', 'asc')->get();
        } else {
            $countries = Country::get();
        }
        return view('management.masterdata.country.index', compact('countries'));

    }

    /**
     * add a new country
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_country(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:districts,name',
            'code' => 'required',
            'region_id' => 'required'
        ]);

        $district = new Country();
        $district->name = $request->input('name');
        $district->code = $request->input('code');
        $district->region_id = $request->input('region_id');
        $district->save();

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'District created successfully.',
            'district' => $district
        ], 201);
    }

    /**
     * show the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_country($id)
    {
        try {
            $district = Country::with('courts')->findOrFail($id);

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
    public function edit_country(Request $request, $id)
    {
        try {
            $country = Country::findOrFail($id);

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
    public function delete_country($id)
    {
        try {
            $district = Country::findOrFail($id);
            $district->delete();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'District deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }
}