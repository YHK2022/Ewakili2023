<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;


class FirmRequestConfirmation extends Model
{

    public function firms()
    {
        return $this->belongsTo(Firm::class, 'firm_id');
    }

}