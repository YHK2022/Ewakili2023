<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SystemLogsController extends Controller
{
    public function logs_index()
    {
        // $logs = Audit::all();
        $logs = DB::table('audits')->get();

        return view('management.masterdata.system.logs', [
            'logs' => $logs,
        ]);

    }
}
