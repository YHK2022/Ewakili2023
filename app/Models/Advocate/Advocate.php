<?php

namespace App\Models\Advocate;

use App\Models\Petitions\Bill;
use App\Profile;
use OwenIt\Auditing\Contracts\Auditable;



use Illuminate\Database\Eloquent\Model;

class Advocate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function bill()
    {
        return $this->hasMany(Bill::class);
    }
}