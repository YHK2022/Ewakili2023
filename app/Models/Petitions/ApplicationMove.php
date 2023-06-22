<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use App\User;
use OwenIt\Auditing\Contracts\Auditable;




class ApplicationMove extends Model 
{
//    use \OwenIt\Auditing\Auditable;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}