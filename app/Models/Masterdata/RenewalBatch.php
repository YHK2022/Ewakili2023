<?php

namespace App\Models\Masterdata;

use Illuminate\Database\Eloquent\Model;
use App\Models\Advocate\RenewalHistory;
use OwenIt\Auditing\Contracts\Auditable;


class RenewalBatch extends Model
{
    public function history()
    {
        return $this->hasMany(RenewalHistory::class);
    }
}