<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use App\User;

class ActionUserTypeUser extends Model
{

    protected $fillable =[
        "user_id", "action_user_type_id"
    ];
    public $timestamps = false;

   public function users()
    {
        return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }
   
}