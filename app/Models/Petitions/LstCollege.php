<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use App\User;


class LstCollege extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}