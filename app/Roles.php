<?php

namespace App;
use App\RoleUser;

use Illuminate\Database\Eloquent\Model;


class Roles extends Model
{

    protected $fillable =[
        "name", "description", "guard_name", "active"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }
}