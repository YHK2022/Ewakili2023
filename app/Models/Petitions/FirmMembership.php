<?php

namespace App\Models\Petitions;

use App\Models\Petitions\Firm;
use App\Profile;
use App\User;

use Illuminate\Database\Eloquent\Model;

class FirmMembership extends Model
{

    public function firm()
    {
        return $this->belongsTo(Firm::class, 'firm_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}