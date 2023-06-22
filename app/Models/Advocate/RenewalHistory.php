<?php

namespace App\Models\Advocate;

use App\Models\Petitions\Application;
use App\Profile;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\Model;
use App\Models\Masterdata\RenewalButch;

class RenewalHistory extends Model implements Auditable
{
 use \OwenIt\Auditing\Auditable;

    public function history()
    {
        return $this->belongsTo(RenewalBatch::class, 'renewal_batch_id');
    }

    public function applications()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}