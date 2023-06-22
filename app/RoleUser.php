<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable =[
        "user_id", "role_id"
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}