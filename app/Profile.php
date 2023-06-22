<?php

namespace App;

use App\Models\Petitions\Application;
use App\Models\Petitions\FirmMembership;
use App\User;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function advocate()
    {
        return $this->hasOne(Advocate::class);
    }

    public function firmMembership()
    {
        return $this->hasMany(FirmMembership::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }
}