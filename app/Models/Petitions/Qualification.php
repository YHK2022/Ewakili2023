<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use App\Profile;



class Qualification extends Model
{

    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}