<?php

namespace App\Models\Petitions;

use App\Models\Advocate\Advocate;
use App\Models\Petitions\BillItem;
use App\Models\Masterdata\FeeType;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model implements Auditable
{  

   use \OwenIt\Auditing\Auditable;

    public function bill_item()
    {
        return $this->hasMany(BillItem::class);
    }

    public function fee_type()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    public function advocate()
    {
        return $this->belongsTo(Advocate::class, 'profile_id');
    }

}