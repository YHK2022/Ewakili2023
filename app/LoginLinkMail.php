<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLinkMail extends Model
{
    protected $fillable =[
        "user_id", "petition_session_id"
    ];
}
