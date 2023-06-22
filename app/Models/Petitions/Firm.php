<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Firm extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function membership()
    {
        return $this->hasMany(FirmMembership::class, 'firm_id');
    }

    public function address()
    {
        return $this->hasMany(FirmAddress::class, 'firm_id');
    }

}