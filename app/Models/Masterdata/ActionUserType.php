<?php

namespace App\Models\Masterdata;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Petitions\Application;
use OwenIt\Auditing\Contracts\Auditable;


class ActionUserType extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'action_user_type_users', 'action_user_type_id', 'user_id');
    }
}