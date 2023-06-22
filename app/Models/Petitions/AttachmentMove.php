<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use App\User;



class AttachmentMove extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}