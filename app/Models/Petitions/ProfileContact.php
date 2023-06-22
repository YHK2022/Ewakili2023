<?php

namespace App\Models\Petitions;

use App\Models\Petitions\Firm;
use App\Profile;
use App\User;

use Illuminate\Database\Eloquent\Model;

class ProfileContact extends Model
{


    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }


}