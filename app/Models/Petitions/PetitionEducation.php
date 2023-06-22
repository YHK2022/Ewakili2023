<?php

namespace App\Models\Petitions;

use Illuminate\Database\Eloquent\Model;
use App\Profile;


class PetitionEducation extends Model
{

    public function profile()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }

    protected $table = 'petition_educations';
}