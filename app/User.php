<?php

namespace App;

use App\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\RoleUser;
use App\Roles;
use Illuminate\Support\Str;
use App\Models\Masterdata\ActionUserType;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
// class User extends Authenticatable implements JWTSubject

{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    // use Notifiable;


    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $table = 'users';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Get the profile record associated with the user
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    // Get the officer record associated with the user
    public function officer()
    {
        return $this->hasOne(Officer::class);
    }

    // Relate user and verified user tables
    public function verifyUser()
    {
    return $this->hasOne('App\VerifyUser');
    }

    public function forms()
    {
        return $this->belongsTo(PetitionForm::class, 'user_id');
    }

    public function progress()
    {
        return $this->hasMany(ApplicationMove::class, 'user_id');
    }

    public function attachment()
    {
        return $this->hasMany(AttachmentMove::class, 'user_id');
    }

    public function documets()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(Aplication::class, 'user_id');
    }

    public function llb()
    {
        return $this->hasOne(LlbCollege::class, 'user_id');
    }

    public function lst()
    {
        return $this->hasOne(LstCollege::class, 'user_id');
    }

    public function experiences()
    {
        return $this->hasMany(WorkExperience::class, 'user_id');
    }
    
public function roles()
    {
        return $this->belongsToMany(Roles::class, 'role_users', 'user_id', 'role_id');
    }
    
    public function actionusers()
    {
        return $this->belongsToMany(ActionUserType::class, 'action_user_type_users', 'action_user_type_id', 'user_id');
    }

    public function generateLoginToken()
{
    $this->login_token = Str::random(60); // Generate a random login token
    $this->save();
    return $this->login_token;
}
}