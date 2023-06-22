<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Masterdata\AttachmentType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttachmentTypeController extends Controller
{
    /**
     * get a listing of districts.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request)
    {
        if ($request->input('all')) {
            $attachments = AttachmentType::orderBy('id', 'asc')->get();
        } else {
            $attachments = AttachmentType::get();
        }
        return view('management.masterdata.attachment.index', compact('attachments'));

    }

    /**
     * add a new attachment
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_attachment(Request $request)
    {
       if (Auth::check()) {

    $this->validate($request, [
        'name' => 'required',
    ]);

    $uuid = Str::uuid();

    $attachment = new AttachmentType();
    $attachment->name = $request->input('name');
    $attachment->created_by = Auth()->user()->id;
    $attachment->uid = $uuid;

    //dd($fee-types);exit;
    $attachment->save();

    return back()->with('success', 'fAttachment added successfully');

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }

    /**
     * show the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_attachment($id)
    {
        try {
            $district = AttachmentType::with('courts')->findOrFail($id);

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
    public function edit_attachment(Request $request, $id)
    {
       if(Auth::check()){

            try {

                $attachment = AttachmentType::findOrFail($id);

                $this->validate($request, [
                    'name' => 'required',
                    
                ]);

                $attachment->name = $request->input('name');

                $attachment->save();

                return back()->with('success', 'Attachment Type edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Attachment Type not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    

    }

    /**
     * delete the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_attachment($id)
    {
        if (Auth::check()) {

    try {
        $permission = AttachmentType::findOrFail($id);
        $permission->delete();

        return back()->with('success', 'User AttachmentType deleted successfully');

    } catch (\Throwable $th) {

        return back()->with('warning', 'User AttachmentType not deleted');
    }

}
return Redirect::to("auth/login")->withErrors('You do not have access!');

    }
}