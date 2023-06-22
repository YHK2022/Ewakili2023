<?php

namespace App\Http\Controllers\Management;

use App\Models\Masterdata\RenewalBatch;
use App\Models\Petitions\AttachmentMove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Profile;

class RenewalBatchController extends Controller
{
    /**
     * get a listing of renewal batches.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $roles = Role::where('name','<>','super-admin')->orderBy('name')->get();

            $batches = RenewalBatch::orderBy('year', 'desc')->get();

            //dd($batches);exit;
            return view('management.masterdata.renewal_batch.index', [
                'profile' => $profile,
                'batches' => $batches,
                'roles' => $roles,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a renewal batch
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_batch(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'start_date' => 'required',
                'first_deadline' => 'required',
                'first_penalt' => 'required',
                'second_deadline' => 'required',
                'second_penalt' => 'required',
                'year' => 'required',
            ]);

            $uuid = Str::uuid();
            $status = "true";
            $new_status = "false";
            $user_id = Auth::user()->id;

            // Find ID of the active batch
            $active_batch_id = RenewalBatch::where('active', $status)->first()->id;


            $batch = new RenewalBatch();
            $batch->active = "true";
            $batch->uid = $uuid;
            $batch->start_date = $request->input('start_date');
            $batch->first_deadline = $request->input('first_deadline');
            $batch->first_penalt = $request->input('first_penalt');
            $batch->second_deadline = $request->input('second_deadline');
            $batch->second_penalt = $request->input('second_penalt');
            $batch->end_date = $request->input('end_date');
            $batch->year = $request->input('year');
            $batch->created_by = $user_id;
            //dd($batch);exit;
            $batch->save();

            if($batch->save()){

                // Update current batch to change active status
                $current_batch = DB::table('renewal_batches')
                    ->where('id', $active_batch_id)
                    ->update(['active' => $new_status]);
            }


            return back()->with('success', 'Renewal batch added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit renewal Batch
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_batch(Request $request, $id)
    {

        if(Auth::check()){

            try {
                $batch = RenewalBatch::findOrFail($id);

                $this->validate($request, [
                    'start_date' => 'required',
                    'first_deadline' => 'required',
                    'first_penalt' => 'required',
                    'second_deadline' => 'required',
                    'second_penalt' => 'required',
                    'year' => 'required',
                ]);

                $batch->active = "true";
                $batch->start_date = $request->input('start_date');
                $batch->first_deadline = $request->input('first_deadline');
                $batch->first_penalt = $request->input('first_penalt');
                $batch->second_deadline = $request->input('second_deadline');
                $batch->second_penalt = $request->input('second_penalt');
                $batch->end_date = $request->input('end_date');
                $batch->year = $request->input('year');
                //dd($batch);exit;
                $batch->save();

                return back()->with('success', 'Renewal batch edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User permission not added');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }



}

