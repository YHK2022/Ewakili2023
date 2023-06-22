<?php

namespace App\Models\Petitions;

use App\Models\Petitions\Firm;
use Illuminate\Database\Eloquent\Model;

class FirmAddress extends Model
{

    public function address()
    {
        return $this->belongsTo(Firm::class, 'firm_id');
    }

    public function membership()
    {
        return $this->belongsTo(FirmMembership::class, 'firm_id');
    }


}