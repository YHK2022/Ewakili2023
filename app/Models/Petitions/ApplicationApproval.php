<?php

namespace App\Models\Petitions;

use App\Models\Petitions\Application;
use Illuminate\Database\Eloquent\Model;

class ApplicationApproval extends Model
{
    //

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
