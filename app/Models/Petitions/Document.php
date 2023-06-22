<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use App\Profile;
use OwenIt\Auditing\Contracts\Auditable;

class Document extends Model implements Auditable
{
     use \OwenIt\Auditing\Auditable;

    protected $fillable = ['user_id','profile_id', 'name', 'file', 'application_id', 'uid', 'upload_date', 'status', 'auther'];
   
    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}