<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'name', 'email', 'password', 'rule', 'status', 'mobile', 'notifications', 'cc'
      ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
    public function getJWTIdentifier()
    {
      return $this->getKey();
    }


    /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
    public function getJWTCustomClaims()
    {
      return [];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }



    /**
     * Get the orders of this customer.
     */
    public function orders()
    {
      return $this->hasMany('App\Models\Order','captain_id');
    }

    public function questions()
    {
      return $this->hasMany('App\Models\Question');
    }

}
