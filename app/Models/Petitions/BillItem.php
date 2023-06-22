<?php

namespace App\Models\Petitions;

use App\Models\Masterdata\Fee;
use App\Models\Petitions\Bill;
use OwenIt\Auditing\Contracts\Auditable;

use Illuminate\Database\Eloquent\Model;
 
class BillItem extends Model implements Auditable
{
   use \OwenIt\Auditing\Auditable;

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
}