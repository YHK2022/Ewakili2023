<?php

namespace App\Models\Advocate;

use App\Profile;
use OwenIt\Auditing\Contracts\Auditable;



use Illuminate\Database\Eloquent\Model;
 
class Certificate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

}